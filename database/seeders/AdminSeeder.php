<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->updateOrInsert(
            ['email' => 'admin@mudea.com'],
            [
                'name' => 'Admin MUDEA',
                'nom' => 'Admin',
                'prenom' => 'MUDEA',
                'email' => 'admin@mudea.com',
                'telephone' => '+225 07 00 00 00 28',
                'password' => Hash::make('12345'),
                'role' => 'admin',
                'statut' => 'actif',
                'photo' => null,
                'adresse' => 'Abidjan, Côte d\'Ivoire',
                'email_verified_at' => now(),
                'remember_token' => null,
                'last_login_at' => null,
                'deleted_at' => null,
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );

        $this->command->info('Utilisateur admin créé avec succès');
        $this->command->info('Email: admin@mudea.com');
        $this->command->info('Mot de passe: 12345');
    }
}
