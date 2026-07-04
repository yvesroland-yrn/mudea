<?php

namespace Tests\Feature;

use App\Models\Message;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminMessagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_and_update_contact_messages(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'email' => 'admin@example.com',
            'telephone' => '+2250100000000',
            'nom' => 'Admin',
            'prenom' => 'Test',
        ]);

        $message = Message::create([
            'prenom' => 'Amani',
            'nom' => 'Kouassi',
            'telephone' => '+2250701010101',
            'email' => 'amani@example.com',
            'objet' => 'projet',
            'message' => 'Bonjour, je souhaite proposer un projet.',
            'statut' => 'nouveau',
        ]);

        $this->actingAs($admin)
            ->get(route('admin.messages'))
            ->assertOk()
            ->assertSee('Amani Kouassi')
            ->assertSee('Bonjour, je souhaite proposer un projet.');

        $this->actingAs($admin)
            ->post(route('admin.messages.status', $message), ['action' => 'read'])
            ->assertRedirect();

        $message->refresh();
        $this->assertSame('lu', $message->statut);
        $this->assertNotNull($message->lu_at);
    }
}
