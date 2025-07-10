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
        Schema::create('qualifications', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->comment('資格名');
            $table->string('code', 20)->unique()->comment('システム用コード');
            $table->timestamps();
        });

        // 初期データ投入
        DB::table('qualifications')->insert([
            ['name' => '補助者', 'code' => 'assistant', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '資格者', 'code' => 'qualified', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('qualifications');
    }
};
