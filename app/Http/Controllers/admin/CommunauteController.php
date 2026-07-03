<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Communaute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CommunauteController extends Controller
{
    /**
     * Afficher la liste des contenus Communauté
     */
    public function index()
    {
        $communautes = Communaute::orderBy('created_at', 'desc')->get();
        return view('admin.communaute', compact('communautes'));
    }

    /**
     * Enregistrer un nouveau contenu
     */
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'categorie' => 'nullable|in:evenements,temoignages,annonces,projets',
            'description' => 'required|string|max:300',
            'image' => 'nullable|file|mimes:jpg,jpeg,png|max:10240',
            'statut' => 'required|in:publie,brouillon',
        ]);

        $data = $request->only(['titre', 'categorie', 'description', 'statut']);

        // Gestion de l'image
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('communautes', 'public');
        }

        Communaute::create($data);

        return redirect()
            ->route('admin.communaute.index')
            ->with('success', 'Le contenu a été créé avec succès.');
    }

    /**
     * Mettre à jour un contenu
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'categorie' => 'nullable|in:evenements,temoignages,annonces,projets',
            'description' => 'required|string|max:300',
            'image' => 'nullable|file|mimes:jpg,jpeg,png|max:10240',
            'statut' => 'required|in:publie,brouillon',
        ]);

        $communaute = Communaute::findOrFail($id);
        $data = $request->only(['titre', 'categorie', 'description', 'statut']);

        // Gestion de l'image
        if ($request->hasFile('image')) {
            // Suppression de l'ancienne image
            if ($communaute->image) {
                Storage::disk('public')->delete($communaute->image);
            }
            $data['image'] = $request->file('image')->store('communautes', 'public');
        }

        $communaute->update($data);

        return redirect()
            ->route('admin.communaute.index')
            ->with('success', 'Le contenu a été mis à jour avec succès.');
    }

    /**
     * Supprimer un contenu
     */
    public function destroy($id)
    {
        $communaute = Communaute::findOrFail($id);

        // Suppression de l'image
        if ($communaute->image) {
            Storage::disk('public')->delete($communaute->image);
        }

        $communaute->delete();

        return redirect()
            ->route('admin.communaute.index')
            ->with('success', 'Le contenu a été supprimé avec succès.');
    }
}
