<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('telephone');
            $table->string('email');
            $table->enum('objet', ['adhesion', 'contribution', 'projet', 'education', 'information', 'autre'])->default('information');
            $table->text('message');
            $table->enum('statut', ['nouveau', 'lu', 'traite', 'archive'])->default('nouveau');
            $table->timestamp('lu_at')->nullable();
            $table->timestamp('traite_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
