<?php

namespace Tests\Feature;

use App\Mail\ContactMessageReceived;
use App\Mail\NewContactMessage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactControllerTest extends TestCase
{
    use RefreshDatabase;
    public function test_web_contact_form_stores_message_and_notifies_admin_and_user(): void
    {
        Mail::fake();

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

        Mail::assertSent(NewContactMessage::class);
        Mail::assertSent(ContactMessageReceived::class);
    }

    public function test_chatbot_submission_stores_message_and_notifies_admin_and_user_when_email_is_provided(): void
    {
        Mail::fake();

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

        Mail::assertSent(NewContactMessage::class);
        Mail::assertSent(ContactMessageReceived::class);
    }
}
