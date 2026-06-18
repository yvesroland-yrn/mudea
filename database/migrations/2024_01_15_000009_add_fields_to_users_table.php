<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nom')->after('id');
            $table->string('prenom')->after('nom');
            $table->string('telephone')->nullable()->after('email');
            $table->enum('role', ['admin', 'moderateur', 'membre'])->default('membre')->after('telephone');
            $table->enum('statut', ['actif', 'inactif'])->default('actif')->after('role');
            $table->string('photo')->nullable()->after('statut');
            $table->text('adresse')->nullable()->after('photo');
            $table->timestamp('last_login_at')->nullable()->after('remember_token');
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'nom',
                'prenom',
                'telephone',
                'role',
                'statut',
                'photo',
                'adresse',
                'last_login_at',
                'deleted_at',
            ]);
        });
    }
};
