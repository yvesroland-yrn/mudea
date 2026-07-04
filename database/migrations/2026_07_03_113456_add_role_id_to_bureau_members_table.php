<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('bureau_members', function (Blueprint $table) {
            // Add role_id column if it doesn't exist
            if (!Schema::hasColumn('bureau_members', 'role_id')) {
                $table->foreignId('role_id')->nullable()->constrained('roles')->onDelete('cascade')->after('id');
            }
        });

        // Migrate existing data from 'role' column to 'role_id'
        $members = DB::table('bureau_members')->whereNull('role_id')->get();

        foreach ($members as $member) {
            if (!empty($member->role)) {
                // Find or create role
                $role = DB::table('roles')->where('nom', $member->role)->first();

                if (!$role) {
                    // Create the role if it doesn't exist
                    $roleId = DB::table('roles')->insertGetId([
                        'nom' => $member->role,
                        'is_custom' => false,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                } else {
                    $roleId = $role->id;
                }

                // Update the member with role_id
                DB::table('bureau_members')
                    ->where('id', $member->id)
                    ->update(['role_id' => $roleId]);
            }
        }

        // Make role_id NOT NULL after migration
        Schema::table('bureau_members', function (Blueprint $table) {
            $table->foreignId('role_id')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bureau_members', function (Blueprint $table) {
            $table->dropForeignIdFor('roles');
            $table->dropColumn('role_id');
        });
    }
};

