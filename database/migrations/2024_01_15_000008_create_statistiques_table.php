<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('statistiques', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // visites, inscriptions, contributions, etc.
            $table->string('cle')->nullable(); // pour distinguer (ex: jour, mois, projet_id)
            $table->bigInteger('valeur')->default(0);
            $table->date('date');
            $table->json('metadonnees')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('statistiques');
    }
};
