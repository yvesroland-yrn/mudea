<?php

namespace App\Http\Controllers;

use App\Mail\ContactMessageReceived;
use App\Mail\NewContactMessage;
use App\Models\Message;
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

        $message = Message::create([
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'telephone' => $validated['telephone'],
            'email' => $validated['email'],
            'objet' => $validated['objet'],
            'message' => $messageText,
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
        $adminEmail = config('mudea.footer.contact.email', config('mail.from.address', 'contact@mudea-ande.ci'));

        try {
            Mail::to($adminEmail)->send(new NewContactMessage($message));
        } catch (\Throwable $e) {
            Log::warning('Erreur d’envoi de l’email admin pour un message de contact', [
                'message_id' => $message->id,
                'error' => $e->getMessage(),
            ]);
        }

        if (! empty($message->email)) {
            try {
                Mail::to($message->email)->send(new ContactMessageReceived($message));
            } catch (\Throwable $e) {
                Log::warning('Erreur d’envoi de l’email de confirmation au contact', [
                    'message_id' => $message->id,
                    'email' => $message->email,
                    'error' => $e->getMessage(),
                ]);
            }
        }
    }
}
