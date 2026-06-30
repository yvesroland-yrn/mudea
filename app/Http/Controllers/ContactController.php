<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $isChatbot = $request->filled('name') || $request->filled('contact') || $request->filled('subject');

        if ($isChatbot) {
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'contact' => ['required', 'string', 'max:255'],
                'subject' => ['required', 'string', 'max:255'],
                'message' => ['required', 'string', 'min:10'],
            ]);

            $nameParts = preg_split('/\s+/', trim($validated['name'])) ?: [];
            $prenom = array_shift($nameParts) ?: 'Utilisateur';
            $nom = trim(implode(' ', $nameParts)) ?: $validated['name'];
            $contact = trim($validated['contact']);

            $message = Message::create([
                'nom' => $nom,
                'prenom' => $prenom,
                'telephone' => str_contains($contact, '@') ? '' : $contact,
                'email' => str_contains($contact, '@') ? $contact : '',
                'objet' => $validated['subject'] === 'adhesion'
                    ? 'adhesion'
                    : ($validated['subject'] === 'projet'
                        ? 'projet'
                        : ($validated['subject'] === 'education'
                            ? 'education'
                            : 'information')),
                'message' => $validated['message'],
                'statut' => 'nouveau',
            ]);

            return response()->json([
                'success' => true,
                'message_id' => $message->id,
            ], 201);
        }

        $validated = $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'objet' => ['required', Rule::in(['adhesion', 'contribution', 'projet', 'education', 'information', 'autre'])],
            'message' => ['required', 'string', 'min:10'],
            'document' => ['nullable', 'file', 'max:10240'],
        ]);

        $documentPath = null;
        $documentName = null;

        if ($request->hasFile('document')) {
            $file = $request->file('document');
            $documentPath = $file->store('contact-documents', 'public');
            $documentName = $file->getClientOriginalName();
        }

        $messageText = $validated['message'];
        if ($documentName) {
            $messageText .= "\n\nDocument joint: " . $documentName;
        }

        Message::create([
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'telephone' => $validated['telephone'],
            'email' => $validated['email'],
            'objet' => $validated['objet'],
            'message' => $messageText,
            'statut' => 'nouveau',
        ]);

        $successMessage = 'Votre message a bien été envoyé. Nous vous répondrons rapidement.';
        if ($documentPath) {
            $successMessage .= ' Votre document a aussi été reçu.';
        }

        return back()->with('success', $successMessage);
    }
}
