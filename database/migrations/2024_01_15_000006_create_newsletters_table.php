<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('newsletters', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('nom')->nullable();
            $table->string('prenom')->nullable();
            $table->enum('statut', ['actif', 'desabonne', 'bounce'])->default('actif');
            $table->timestamp('desabonne_at')->nullable();
            $table->string('token')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('newsletters');
    }
};
