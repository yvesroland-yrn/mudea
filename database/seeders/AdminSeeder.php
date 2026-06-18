<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@mudea.com'],
            [
                'nom' => 'Admin',
                'prenom' => 'MUDEA',
                'email' => 'admin@mudea.com',
                'telephone' => '+225 07 00 00 00 28',
                'password' => Hash::make('12345'),
                'role' => 'admin',
                'statut' => 'actif',
                'adresse' => 'Abidjan, Côte d\'Ivoire',
            ]
        );

        $this->command->info('Utilisateur admin créé avec succès');
        $this->command->info('Email: admin@mudea.com');
        $this->command->info('Mot de passe: 12345');
    }
}
