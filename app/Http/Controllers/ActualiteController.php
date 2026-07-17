<?php

namespace App\Http\Controllers;

use App\Models\Actualite;
use Illuminate\Http\Request;

class ActualiteController extends Controller
{
    /**
     * Affiche la liste des actualités publiées
     */
    public function index(Request $request)
    {
        $query = Actualite::publie();

        // Filtre par catégorie
        if ($request->filled('categorie')) {
            $query->where('categorie', $request->categorie);
        }

        // Recherche
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('titre', 'like', "%{$search}%")
                    ->orWhere('resume', 'like', "%{$search}%")
                    ->orWhere('contenu', 'like', "%{$search}%");
            });
        }

        $actualites = $query->orderBy('epingle', 'desc')
            ->orderBy('date_publication', 'desc')
            ->paginate(9);

        $categories = Actualite::publie()
            ->distinct()
            ->pluck('categorie')
            ->filter()
            ->values();

        return view('pages.actualites.index', [
            'actualites' => $actualites,
            'categories' => $categories,
            'selectedCategory' => $request->categorie ?? '',
            'searchQuery' => $request->search ?? '',
        ]);
    }

    /**
     * Affiche le détail d'une actualité
     */
    public function show($slug)
    {
        $actualite = Actualite::where('slug', $slug)
            ->publie()
            ->firstOrFail();

        // Incrémenter les vues
        $actualite->increment('vues');

        // Récupérer les actualités connexes (même catégorie, exclure la courante)
        $connexes = Actualite::where('categorie', $actualite->categorie)
            ->where('id', '!=', $actualite->id)
            ->publie()
            ->orderBy('date_publication', 'desc')
            ->limit(3)
            ->get();

        return view('pages.actualites.show', [
            'actualite' => $actualite,
            'connexes' => $connexes,
        ]);
    }
}
