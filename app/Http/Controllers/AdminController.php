<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function actualites()
    {
        return redirect()->route('admin.actualites.index');
    }

    public function pages()
    {
        return view('admin.pages');
    }

    public function vieCoutumes()
    {
        return view('admin.vie-coutumes');
    }

    public function education()
    {
        return view('admin.education');
    }

    public function communaute()
    {
        return view('admin.communaute');
    }

    
    public function bureau()
    {
        return view('admin.bureau');
    }

    public function projets()
    {
        return view('admin.projets', [
            'projets' => Projet::latest()->get(),
        ]);
    }

    protected function validateProjet(Request $request): array
    {
        return $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'statut' => 'required|in:en-cours,realise,futur',
            'secteur' => 'nullable|in:education,sante,eau,infrastructure,energie,agriculture',
            'budget' => 'nullable|string|max:100',
            'avancement' => 'nullable|integer|min:0|max:100',
            'date_debut' => 'required|date',
            'date_fin' => 'nullable|date|after_or_equal:date_debut',
            'media' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:20480',
        ]);
    }

    public function storeProjet(Request $request)
    {
        $validated = $this->validateProjet($request);
        $validated['slug'] = Str::slug($validated['titre']);
        $validated['featured'] = false;

        if ($request->hasFile('media')) {
            $path = $request->file('media')->store('projets', 'public');
            $validated['media'] = $path;
        }

        Projet::create($validated);

        return redirect()->route('admin.projets')->with('success', 'Projet ajouté avec succès.');
    }

    public function updateProjet(Request $request, Projet $projet)
    {
        $validated = $this->validateProjet($request);
        $validated['slug'] = Str::slug($validated['titre']);

        if ($request->hasFile('media')) {
            $path = $request->file('media')->store('projets', 'public');
            $validated['media'] = $path;
        }

        $projet->update($validated);

        return redirect()->route('admin.projets')->with('success', 'Projet modifié avec succès.');
    }

    public function destroyProjet(Projet $projet)
    {
        $projet->delete();

        return redirect()->route('admin.projets')->with('success', 'Projet supprimé avec succès.');
    }

    public function messages()
    {
        return view('admin.messages');
    }

    public function utilisateurs()
    {
        return view('admin.utilisateurs');
    }

    public function parametres()
    {
        return view('admin.parametres');
    }

    public function statistiques()
    {
        return view('admin.statistiques');
    }
}
