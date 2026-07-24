<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Support\PublicUpload;
use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    /**
     * Afficher la liste des contenus Education
     */
    public function index()
    {
        $educations = Education::orderBy('created_at', 'desc')->get();
        return view('admin.education', compact('educations'));
    }

    /**
     * Enregistrer un nouveau contenu
     */
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'categorie' => 'required|in:excellence,numerique,innovation,bourses',
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
            $data['media'] = PublicUpload::store($request->file('media'), 'education');
        }

        Education::create($data);

        return redirect()
            ->route('admin.education.index')
            ->with('success', 'L\'image a été ajoutée avec succès.');
    }

    /**
     * Mettre à jour un contenu
     */
    public function update(Request $request, int $id)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'categorie' => 'required|in:excellence,numerique,innovation,bourses',
            'description' => 'required|string|max:300',
            'media' => 'nullable|file|mimes:jpg,jpeg,png|max:20480',
            'statut' => 'required|in:publie,brouillon',
        ]);

        $education = Education::findOrFail($id);
        $data = $request->only(['titre', 'categorie', 'description', 'statut']);

        // Gestion du média
        if ($request->hasFile('media')) {
            // Suppression de l'ancien média
            if ($education->media) {
                PublicUpload::delete($education->media);
            }
            $data['media'] = PublicUpload::store($request->file('media'), 'education');
        }

        $education->update($data);

        return redirect()
            ->route('admin.education.index')
            ->with('success', 'L\'image a été mise à jour avec succès.');
    }

    /**
     * Supprimer un contenu
     */
    public function destroy(int $id)
    {
        $education = Education::findOrFail($id);

        // Suppression du média
        if ($education->media) {
            PublicUpload::delete($education->media);
        }

        $education->delete();

        return redirect()
            ->route('admin.education.index')
            ->with('success', 'L\'image a été supprimée avec succès.');
    }
}
