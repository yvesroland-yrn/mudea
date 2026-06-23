<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('actualites', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('slug')->unique();
            $table->enum('categorie', ['projets', 'education', 'communaute', 'culture', 'sante', 'actualite'])->default('actualite');
            $table->enum('statut', ['publie', 'brouillon', 'archive'])->default('brouillon');
            $table->string('auteur');
            $table->date('date_publication')->nullable();
            $table->string('resume', 300);
            $table->text('contenu');
            $table->string('image')->nullable();
            $table->json('tags')->nullable();
            $table->unsignedInteger('vues')->default(0);
            $table->boolean('epingle')->default(false);
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('actualites');
    }
};
