<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->unique();
            $table->boolean('is_custom')->default(false);
            $table->timestamps();
        });

        // Rôles prédéfinis
        DB::table('roles')->insert([
            ['nom' => 'Président', 'is_custom' => false],
            ['nom' => 'Vice-Président', 'is_custom' => false],
            ['nom' => 'Secrétaire Général', 'is_custom' => false],
            ['nom' => 'Trésorier', 'is_custom' => false],
            ['nom' => 'Secrétaire Adjoint', 'is_custom' => false],
            ['nom' => 'Trésorier Adjoint', 'is_custom' => false],
            ['nom' => 'Conseiller', 'is_custom' => false],
            ['nom' => 'Membre', 'is_custom' => false],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
