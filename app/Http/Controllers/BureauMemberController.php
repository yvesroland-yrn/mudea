<?php

namespace App\Http\Controllers;

use App\Models\BureauMember;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BureauMemberController extends Controller
{
    public function index()
    {
        return view('admin.bureau', [
            'members' => BureauMember::latest()->get(),
            'membersCount' => BureauMember::count(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'prenom' => 'required|string|max:100',
            'nom' => 'required|string|max:100',
            'role' => 'required|string|max:120',
            'mandat' => 'nullable|string|max:120',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('bureau', 'public');
            $validated['photo'] = 'storage/' . $path;
        }

        BureauMember::create($validated);

        return redirect()->route('admin.bureau')->with('success', 'Membre ajouté avec succès.');
    }
}
