<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $email = 'admin2026@mudea.com';
        $password = 'Mudea@2026!';

        DB::table('users')->updateOrInsert(
            ['email' => $email],
            [
                'name' => 'Admin MUDEA',
                'nom' => 'Admin',
                'prenom' => 'MUDEA',
                'email' => $email,
                'telephone' => '+225 07 00 00 00 28',
                'password' => Hash::make($password),
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
        $this->command->info('Email: ' . $email);
        $this->command->info('Mot de passe: ' . $password);
    }
}
