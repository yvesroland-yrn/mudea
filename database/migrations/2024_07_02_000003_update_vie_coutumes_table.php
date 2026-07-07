<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // D'abord, mettre à jour toutes les données existantes à 'photos'
        DB::table('vie_coutumes')->update(['type' => 'photos']);

        Schema::table('vie_coutumes', function (Blueprint $table) {
            // Modifier le type pour ne garder que 'photos'
            $table->enum('type', ['photos'])->default('photos')->change();

            // Changer date en datetime pour stocker l'heure aussi
            $table->dateTime('date_publication')->nullable()->change();

            // Rendre categorie requis
            $table->enum('categorie', ['traditions', 'ceremonies', 'gastronomie', 'temoignages'])->nullable(false)->default('traditions')->change();
        });
    }

    public function down(): void
    {
        Schema::table('vie_coutumes', function (Blueprint $table) {
            $table->enum('type', ['article', 'photos', 'video'])->default('article')->change();
            $table->date('date_publication')->nullable()->change();
            $table->enum('categorie', ['traditions', 'ceremonies', 'gastronomie', 'temoignages'])->nullable()->change();
        });
    }
};
