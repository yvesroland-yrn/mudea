<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('education', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->enum('type', ['photos'])->default('photos');
            $table->enum('categorie', ['excellence', 'numerique', 'innovation', 'bourses'])->nullable(false)->default('excellence');
            $table->enum('statut', ['publie', 'brouillon'])->default('brouillon');
            $table->string('description', 300);
            $table->string('media')->nullable();
            $table->dateTime('date_publication')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('education');
    }
};
