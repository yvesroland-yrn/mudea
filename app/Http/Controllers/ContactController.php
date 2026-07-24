<?php

namespace App\Http\Controllers;

use App\Mail\ContactReceivedMail;
use App\Mail\NewContactMail;
use App\Models\Message;
use App\Models\User;
use App\Support\PublicUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
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

            $this->sendNotifications($message);

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

        if ($request->hasFile('document')) {
            $file = $request->file('document');
            $documentPath = PublicUpload::store($file, 'messages');
        }

        $messageText = $validated['message'];

        $message = Message::create([
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'telephone' => $validated['telephone'],
            'email' => $validated['email'],
            'objet' => $validated['objet'],
            'message' => $messageText,
            'fichier' => $documentPath,
            'statut' => 'nouveau',
        ]);

        $this->sendNotifications($message);

        $successMessage = 'Votre message a bien été envoyé. Nous vous répondrons rapidement.';
        if ($documentPath) {
            $successMessage .= ' Votre document a aussi été reçu.';
        }

        return back()->with('success', $successMessage);
    }

    private function sendNotifications(Message $message): void
    {
        $adminEmails = User::where('role', 'admin')
            ->whereNotNull('email')
            ->pluck('email')
            ->filter()
            ->unique()
            ->values()
            ->toArray();


        if (! empty($adminEmails)) {
            try {
                Mail::to($adminEmails)->send(new NewContactMail($message));
            } catch (\Throwable $e) {
                Log::warning('Erreur d’envoi de l’e-mail aux administrateurs pour un message de contact', [
                    'message_id' => $message->id,
                    'error' => $e->getMessage(),
                ]);
            }
        } else {
            Log::warning('Aucun administrateur avec une adresse e-mail valide trouvé', [
                'message_id' => $message->id,
            ]);
        }

        if (! empty($message->email)) {
            try {
                Mail::to($message->email)->send(new ContactReceivedMail($message));
            } catch (\Throwable $e) {
                Log::warning('Erreur d’envoi de l’e-mail de confirmation au contact', [
                    'message_id' => $message->id,
                    'email' => $message->email,
                    'error' => $e->getMessage(),
                ]);
            }
        }
    }
}
