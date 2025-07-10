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
        // "user" を "general" に変更
        DB::table('roles')
            ->where('code', 'user')
            ->update(['code' => 'general']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // ロールバック時は "general" を "user" に戻す
        DB::table('roles')
            ->where('code', 'general')
            ->update(['code' => 'user']);
    }
};
