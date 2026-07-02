<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vie_coutumes', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->enum('type', ['article', 'photos', 'video'])->default('article');
            $table->enum('categorie', ['traditions', 'ceremonies', 'gastronomie', 'temoignages'])->nullable();
            $table->enum('statut', ['publie', 'brouillon'])->default('brouillon');
            $table->string('description', 300);
            $table->string('media')->nullable();
            $table->date('date_publication')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vie_coutumes');
    }
};
