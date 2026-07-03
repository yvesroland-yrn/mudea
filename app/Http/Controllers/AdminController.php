<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
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

    protected function validateUtilisateur(Request $request, ?User $user = null): array
    {
        $isUpdate = $user !== null;

        return $request->validate([
            'nom_complet' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($user?->id),
            ],
            'telephone' => 'nullable|string|max:25',
            'role' => $isUpdate ? 'required|in:admin,moderateur,membre' : 'nullable|in:admin,moderateur,membre',
            'statut' => $isUpdate ? 'required|in:actif,inactif' : 'nullable|in:actif,inactif',
            'password' => $isUpdate ? 'nullable|string|min:8|confirmed' : 'required|string|min:8|confirmed',
        ], [
            'nom_complet.required' => 'Le nom est requis.',
            'email.required' => 'L\'email est requis.',
            'email.email' => 'L\'email doit être une adresse email valide.',
            'email.unique' => 'Cet email est déjà utilisé.',
            'role.required' => 'Le rôle est requis.',
            'statut.required' => 'Le statut est requis.',
            'password.required' => 'Le mot de passe est requis.',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
        ]);
    }

    public function storeUtilisateur(Request $request)
    {
        $validated = $this->validateUtilisateur($request);

        $validated['role'] = $validated['role'] ?? 'admin';
        $validated['statut'] = $validated['statut'] ?? 'actif';
        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('admin.utilisateurs')->with('success', 'Utilisateur créé avec succès.');
    }

    public function updateUtilisateur(Request $request, User $user)
    {
        $validated = $this->validateUtilisateur($request, $user);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('admin.utilisateurs')->with('success', 'Utilisateur modifié avec succès.');
    }

    public function utilisateurs()
    {
        $users = User::latest()->get();

        return view('admin.utilisateurs', [
            'users' => $users,
            'totalUsers' => $users->count(),
            'activeUsers' => $users->where('statut', 'actif')->count(),
            'adminsCount' => $users->where('role', 'admin')->count(),
            'newThisMonth' => User::whereMonth('created_at', now()->month)->count(),
        ]);
    }

    public function parametres()
    {
        return view('admin.parametres', [
            'currentUser' => auth()->user(),
        ]);
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed', Password::defaults()],
        ], [
            'current_password.required' => 'Le mot de passe actuel est requis.',
            'current_password.current_password' => 'Le mot de passe actuel est incorrect.',
            'password.required' => 'Le nouveau mot de passe est requis.',
            'password.min' => 'Le nouveau mot de passe doit contenir au moins 8 caractères.',
            'password.confirmed' => 'La confirmation du nouveau mot de passe ne correspond pas.',
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('admin.parametres')->with('success', 'Mot de passe modifié avec succès.');
    }

    public function statistiques()
    {
        return view('admin.statistiques');
    }
}
