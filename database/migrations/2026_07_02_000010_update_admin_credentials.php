<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    public function up(): void
    {
        $oldEmail = 'admin@mudea.com';
        $newEmail = 'admin2026@mudea.com';
        $newPassword = 'Mudea@2026!';

        if (DB::table('users')->where('email', $oldEmail)->exists()) {
            DB::table('users')
                ->where('email', $oldEmail)
                ->update([
                    'email' => $newEmail,
                    'password' => Hash::make($newPassword),
                    'updated_at' => now(),
                ]);

            return;
        }

        DB::table('users')->updateOrInsert(
            ['email' => $newEmail],
            [
                'nom' => 'Admin',
                'prenom' => 'MUDEA',
                'email' => $newEmail,
                'telephone' => '+225 07 00 00 00 28',
                'password' => Hash::make($newPassword),
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
    }

    public function down(): void
    {
        $oldEmail = 'admin@mudea.com';
        $newEmail = 'admin2026@mudea.com';
        $oldPassword = '12345';

        if (DB::table('users')->where('email', $newEmail)->exists()) {
            DB::table('users')
                ->where('email', $newEmail)
                ->update([
                    'email' => $oldEmail,
                    'password' => Hash::make($oldPassword),
                    'updated_at' => now(),
                ]);
        }
    }
};
