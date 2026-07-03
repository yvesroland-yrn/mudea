<?php

namespace Tests\Feature;

use App\Mail\ContactReceivedMail;
use App\Mail\NewContactMail;
use App\Models\Message;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactControllerTest extends TestCase
{
    use RefreshDatabase;
    public function test_web_contact_form_stores_message_and_notifies_admin_and_user(): void
    {
        Mail::fake();
        User::factory()->create([
            'role' => 'admin',
            'email' => 'admin@example.com',
            'telephone' => '+2250100000000',
            'nom' => 'Admin',
            'prenom' => 'Test',
        ]);

        $response = $this->from('/contact')->post(route('contact.store'), [
            'nom' => 'Kouassi',
            'prenom' => 'Amani',
            'telephone' => '+2250701010101',
            'email' => 'amani@example.com',
            'objet' => 'projet',
            'message' => 'Je souhaite proposer un projet de jardin communautaire.',
        ]);

        $response->assertRedirect('/contact');
        $this->assertDatabaseHas('messages', [
            'email' => 'amani@example.com',
            'objet' => 'projet',
            'statut' => 'nouveau',
        ]);

        Mail::assertSent(NewContactMail::class);
        Mail::assertSent(ContactReceivedMail::class);
    }

    public function test_chatbot_submission_stores_message_and_notifies_admin_and_user_when_email_is_provided(): void
    {
        Mail::fake();
        User::factory()->create([
            'role' => 'admin',
            'email' => 'admin@example.com',
            'telephone' => '+2250100000000',
            'nom' => 'Admin',
            'prenom' => 'Test',
        ]);

        $response = $this->postJson(route('contact.store'), [
            'name' => 'Mariam Koné',
            'contact' => 'mariam@example.com',
            'subject' => 'education',
            'message' => 'Bonjour, j’ai besoin d’informations sur les bourses.',
        ]);

        $response->assertStatus(201)
            ->assertJsonPath('success', true);

        $this->assertDatabaseHas('messages', [
            'email' => 'mariam@example.com',
            'objet' => 'education',
            'statut' => 'nouveau',
        ]);

        Mail::assertSent(NewContactMail::class);
        Mail::assertSent(ContactReceivedMail::class);
    }

    public function test_confirmation_email_renders_the_contact_name(): void
    {
        $message = Message::create([
            'prenom' => 'Amani',
            'nom' => 'Kouassi',
            'telephone' => '+2250701010101',
            'email' => 'amani@example.com',
            'objet' => 'projet',
            'message' => 'Bonjour, je souhaite proposer un projet.',
            'statut' => 'nouveau',
        ]);

        $mailable = new ContactReceivedMail($message);
        $rendered = $mailable->render();

        $this->assertStringContainsString('Bonjour Amani', $rendered);
        $this->assertStringContainsString('Bonjour, je souhaite proposer un projet.', $rendered);
    }
}
