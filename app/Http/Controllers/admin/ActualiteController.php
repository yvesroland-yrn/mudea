<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ActualiteRequest;
use App\Services\ActualiteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActualiteController extends Controller
{
    public function __construct(
        protected ActualiteService $actualiteService
    ) {}

    /**
     * Afficher la liste des actualités
     */
    public function index(Request $request)
    {
        // Préparer les filtres
        $filters = [
            'search' => $request->input('search'),
            'categorie' => $request->input('categorie'),
            'statut' => $request->input('statut'),
            'sort_by' => $request->input('sort_by', 'created_at'),
            'sort_order' => $request->input('sort_order', 'desc'),
        ];

        // Récupérer les actualités
        $actualites = $this->actualiteService->getAll($filters, 10);

        // Retourner la vue
        return view('admin.actualites.index', [
            'actualites' => $actualites,
            'total' => $actualites->total(),
        ]);
    }

    /**
     * Afficher le formulaire de création
     */
    public function create()
    {
        return view('admin.actualites.create');
    }

    /**
     * Enregistrer une nouvelle actualité
     */
    public function store(ActualiteRequest $request)
    {
        // Valider les données
        $data = $request->validated();

        // Gestion de l'auteur par défaut
        if (empty($data['auteur'])) {
            $data['auteur'] = Auth::user()->nom . ' ' . Auth::user()->prenom;
        }

        // Créer l'actualité
        $actualite = $this->actualiteService->create($data);

        return redirect()
            ->route('admin.actualites.index')
            ->with('success', 'L\'actualité a été créée avec succès.');
    }

    /**
     * Afficher une actualité
     */
    public function show(int $id)
    {
        $actualite = $this->actualiteService->getById($id);

        if (!$actualite) {
            return redirect()
                ->route('admin.actualites.index')
                ->with('error', 'Actualité non trouvée.');
        }

        return view('admin.actualites.show', compact('actualite'));
    }

    /**
     * Afficher le formulaire d'édition
     */
    public function edit(int $id)
    {
        $actualite = $this->actualiteService->getById($id);

        if (!$actualite) {
            return redirect()
                ->route('admin.actualites.index')
                ->with('error', 'Actualité non trouvée.');
        }

        return view('admin.actualites.edit', compact('actualite'));
    }

    /**
     * Mettre à jour une actualité
     */
    public function update(ActualiteRequest $request, int $id)
    {
        $data = $request->validated();

        $actualite = $this->actualiteService->update($id, $data);

        if (!$actualite) {
            return redirect()
                ->route('admin.actualites.index')
                ->with('error', 'Actualité non trouvée.');
        }

        return redirect()
            ->route('admin.actualites.index')
            ->with('success', 'L\'actualité a été mise à jour avec succès.');
    }

    /**
     * Supprimer une actualité
     */
    public function destroy(int $id)
    {
        $success = $this->actualiteService->delete($id);

        if (!$success) {
            return redirect()
                ->route('admin.actualites.index')
                ->with('error', 'Actualité non trouvée.');
        }

        return redirect()
            ->route('admin.actualites.index')
            ->with('success', 'L\'actualité a été supprimée avec succès.');
    }

    /**
     * Changer le statut d'une actualité
     */
    public function changeStatut(Request $request, int $id)
    {
        $request->validate([
            'statut' => 'required|in:brouillon,publie,archive',
        ]);

        $actualite = $this->actualiteService->changeStatut($id, $request->statut);

        if (!$actualite) {
            return response()->json(['success' => false], 404);
        }

        return response()->json(['success' => true]);
    }
}
