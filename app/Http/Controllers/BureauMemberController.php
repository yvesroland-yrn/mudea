<?php

namespace App\Http\Controllers;

use App\Models\BureauMember;
use App\Support\PublicUpload;
use App\Models\Role;
use Illuminate\Http\Request;

class BureauMemberController extends Controller
{
    public function index(Request $request)
    {
        $query = BureauMember::with('role');

        // Filtre par rôle
        if ($request->filled('role_id')) {
            $query->where('role_id', $request->role_id);
        }

        // Filtre par recherche
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('prenom', 'like', "%{$search}%")
                    ->orWhere('nom', 'like', "%{$search}%")
                    ->orWhere('mandat', 'like', "%{$search}%");
            });
        }

        $members = $query->latest()->get();

        // Stats dynamiques
        $totalMembers = BureauMember::count();
        $presidentCount = BureauMember::whereHas('role', fn($q) => $q->where('nom', 'Président'))->count();
        $secretairesCount = BureauMember::whereHas('role', fn($q) => $q->whereIn('nom', ['Secrétaire Général', 'Secrétaire Adjoint']))->count();
        $tresorierCount = BureauMember::whereHas('role', fn($q) => $q->whereIn('nom', ['Trésorier', 'Trésorier Adjoint']))->count();

        return view('admin.bureau', [
            'members' => $members,
            'roles' => Role::where('is_custom', false)->orderBy('nom')->get(),
            'allRoles' => Role::orderBy('is_custom')->orderBy('nom')->get(),
            'stats' => [
                'total' => $totalMembers,
                'president' => $presidentCount,
                'secretaires' => $secretairesCount,
                'tresoriers' => $tresorierCount,
            ],
            'filters' => [
                'role_id' => $request->role_id ?? '',
                'search' => $request->search ?? '',
            ],
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'role_id' => 'required|string',
            'custom_role' => 'required_if:role_id,custom|nullable|string|max:120',
            'prenom' => 'required|string|max:100',
            'nom' => 'required|string|max:100',
            'mandat' => 'nullable|string|max:120',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $roleId = null;

        // Si rôle personnalisé, créer ou utiliser le rôle existant
        if ($request->role_id === 'custom') {
            if (empty($request->custom_role)) {
                return redirect()->back()->withErrors(['custom_role' => 'Veuillez spécifier le rôle personnalisé.']);
            }

            // Vérifier si le rôle existe déjà
            $existingRole = Role::where('nom', $request->custom_role)
                ->where('is_custom', true)
                ->first();

            if ($existingRole) {
                $roleId = $existingRole->id;
            } else {
                $role = Role::create([
                    'nom' => $request->custom_role,
                    'is_custom' => true,
                ]);
                $roleId = $role->id;
            }
        } else {
            // Vérifier que le role_id existe dans la table roles
            $role = Role::find($request->role_id);
            if (!$role) {
                return redirect()->back()->withErrors(['role_id' => 'Le rôle sélectionné est invalide.']);
            }
            $roleId = $request->role_id;
        }

        $dataToCreate = [
            'role_id' => $roleId,
            'prenom' => $validated['prenom'],
            'nom' => $validated['nom'],
            'mandat' => $validated['mandat'] ?? null,
        ];

        if ($request->hasFile('photo')) {
            $path = PublicUpload::store($request->file('photo'), 'bureau');
            $dataToCreate['photo'] = $path;
        }

        BureauMember::create($dataToCreate);

        return redirect()->route('admin.bureau.index')->with('success', 'Membre ajouté avec succès.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'role_id' => 'required|string',
            'custom_role' => 'required_if:role_id,custom|nullable|string|max:120',
            'prenom' => 'required|string|max:100',
            'nom' => 'required|string|max:100',
            'mandat' => 'nullable|string|max:120',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $member = BureauMember::findOrFail($id);
        $roleId = null;

        // Si rôle personnalisé, créer ou utiliser le rôle existant
        if ($request->role_id === 'custom') {
            if (empty($request->custom_role)) {
                return redirect()->back()->withErrors(['custom_role' => 'Veuillez spécifier le rôle personnalisé.']);
            }

            // Vérifier si le rôle existe déjà
            $existingRole = Role::where('nom', $request->custom_role)
                ->where('is_custom', true)
                ->first();

            if ($existingRole) {
                $roleId = $existingRole->id;
            } else {
                $role = Role::create([
                    'nom' => $request->custom_role,
                    'is_custom' => true,
                ]);
                $roleId = $role->id;
            }
        } else {
            // Vérifier que le role_id existe dans la table roles
            $role = Role::find($request->role_id);
            if (!$role) {
                return redirect()->back()->withErrors(['role_id' => 'Le rôle sélectionné est invalide.']);
            }
            $roleId = $request->role_id;
        }

        $dataToUpdate = [
            'role_id' => $roleId,
            'prenom' => $validated['prenom'],
            'nom' => $validated['nom'],
            'mandat' => $validated['mandat'] ?? null,
        ];

        if ($request->hasFile('photo')) {
            // Suppression de l'ancienne photo
            if ($member->photo) {
                PublicUpload::delete($member->photo);
            }
            $dataToUpdate['photo'] = PublicUpload::store($request->file('photo'), 'bureau');
        }

        $member->update($dataToUpdate);

        return redirect()->route('admin.bureau.index')->with('success', 'Membre mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $member = BureauMember::findOrFail($id);

        // Suppression de la photo
        if ($member->photo) {
            PublicUpload::delete($member->photo);
        }

        $member->delete();

        return redirect()->route('admin.bureau.index')->with('success', 'Membre supprimé avec succès.');
    }
}
