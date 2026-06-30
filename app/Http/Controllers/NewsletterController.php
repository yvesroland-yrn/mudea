<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'max:255'],
        ]);

        Newsletter::updateOrCreate(
            ['email' => $validated['email']],
            [
                'statut' => 'actif',
                'nom' => null,
                'prenom' => null,
                'desabonne_at' => null,
                'token' => Newsletter::query()->where('email', $validated['email'])->value('token') ?? bin2hex(random_bytes(16)),
            ]
        );

        return back()->with('success', "Merci ! Votre inscription à la newsletter a bien été prise en compte.");
    }
}
