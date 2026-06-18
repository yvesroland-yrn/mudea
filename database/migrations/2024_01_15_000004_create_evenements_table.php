<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('evenements', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->date('date');
            $table->string('lieu');
            $table->time('heure_debut');
            $table->time('heure_fin')->nullable();
            $table->string('image')->nullable();
            $table->enum('statut', ['a_venir', 'en_cours', 'termine', 'annule'])->default('a_venir');
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('evenements');
    }
};
