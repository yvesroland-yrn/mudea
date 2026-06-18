<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projets', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('slug')->unique();
            $table->text('description');
            $table->enum('statut', ['en-cours', 'realise', 'futur'])->default('futur');
            $table->enum('secteur', ['education', 'sante', 'eau', 'infrastructure', 'energie', 'agriculture'])->nullable();
            $table->string('budget')->nullable();
            $table->unsignedInteger('avancement')->default(0);
            $table->date('date_debut');
            $table->date('date_fin')->nullable();
            $table->string('media')->nullable();
            $table->boolean('featured')->default(false);
            $table->foreignId('responsable_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projets');
    }
};
