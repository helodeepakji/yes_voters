<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('gender')->nullable()->after('email');
            $table->string('phone')->nullable()->after('gender');
            $table->unsignedBigInteger('role_id')->nullable()->after('phone');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('set null');
            $table->foreignId('team_id')->nullable()->constrained()->onDelete('set null');
            $table->boolean('is_team_leader')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropColumn(['gender', 'phone', 'role_id']);
        });
    }
};
