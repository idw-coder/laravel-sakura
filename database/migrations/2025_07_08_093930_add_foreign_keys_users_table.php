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
            $table->string('admin_id')->nullable()->after('email')->comment('管理者ID');
            $table->foreignId('qualification_id')->nullable()->after('admin_id')->constrained('qualifications')->comment('資格ID');
            $table->foreignId('role_id')->default(1)->after('qualification_id')->constrained('roles')->comment('役割ID');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['qualification_id']);
            $table->dropForeign(['role_id']);
            $table->dropColumn(['admin_id', 'qualification_id', 'role_id']);
        });
    }
};
