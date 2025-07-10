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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->comment('表示名');
            $table->string('code', 20)->unique()->comment('システム用コード');
            $table->timestamps();
        });

        // 初期データ投入
        DB::table('roles')->insert([
            ['name' => '一般', 'code' => 'user', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '管理者', 'code' => 'admin', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
