<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VieCoutume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VieCoutumeController extends Controller
{
    /**
     * Afficher la liste des contenus Vie & Coutumes
     */
    public function index()
    {
        $vieCoutumes = VieCoutume::orderBy('created_at', 'desc')->get();
        return view('admin.vie-coutumes', compact('vieCoutumes'));
    }

    /**
     * Enregistrer un nouveau contenu
     */
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'categorie' => 'required|in:traditions,ceremonies,gastronomie,temoignages',
            'description' => 'required|string|max:300',
            'media' => 'required|file|mimes:jpg,jpeg,png|max:20480',
            'statut' => 'required|in:publie,brouillon',
        ]);

        $data = $request->only([
            'titre',
            'categorie',
            'description',
            'statut'
        ]);

        $data['type'] = 'photos';
        $data['date_publication'] = now();

        // Gestion du média
        if ($request->hasFile('media')) {
            $data['media'] = $request->file('media')->store('vie-coutumes', 'public');
        }

        VieCoutume::create($data);

        return redirect()
            ->route('admin.vie-coutumes.index')
            ->with('success', 'L\'image a été ajoutée avec succès.');
    }

    /**
     * Mettre à jour un contenu
     */
    public function update(Request $request, int $id)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'categorie' => 'required|in:traditions,ceremonies,gastronomie,temoignages',
            'description' => 'required|string|max:300',
            'media' => 'nullable|file|mimes:jpg,jpeg,png|max:20480',
            'statut' => 'required|in:publie,brouillon',
        ]);

        $vieCoutume = VieCoutume::findOrFail($id);
        $data = $request->only(['titre', 'categorie', 'description', 'statut']);

        // Gestion du média
        if ($request->hasFile('media')) {
            // Suppression de l'ancien média
            if ($vieCoutume->media) {
                Storage::disk('public')->delete($vieCoutume->media);
            }
            $data['media'] = $request->file('media')->store('vie-coutumes', 'public');
        }

        $vieCoutume->update($data);

        return redirect()
            ->route('admin.vie-coutumes.index')
            ->with('success', 'L\'image a été mise à jour avec succès.');
    }

    /**
     * Supprimer un contenu
     */
    public function destroy(int $id)
    {
        $vieCoutume = VieCoutume::findOrFail($id);

        // Suppression du média
        if ($vieCoutume->media) {
            Storage::disk('public')->delete($vieCoutume->media);
        }

        $vieCoutume->delete();

        return redirect()
            ->route('admin.vie-coutumes.index')
            ->with('success', 'L\'image a été supprimée avec succès.');
    }
}
