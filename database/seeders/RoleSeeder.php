<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['nom' => 'Président', 'is_custom' => false],
            ['nom' => 'Vice-Président', 'is_custom' => false],
            ['nom' => 'Secrétaire Général', 'is_custom' => false],
            ['nom' => 'Secrétaire Adjoint', 'is_custom' => false],
            ['nom' => 'Trésorier', 'is_custom' => false],
            ['nom' => 'Trésorier Adjoint', 'is_custom' => false],
            ['nom' => 'Conseiller', 'is_custom' => false],
            ['nom' => 'Membre', 'is_custom' => false],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(
                ['nom' => $role['nom']],
                ['is_custom' => $role['is_custom']]
            );
        }
    }
}
