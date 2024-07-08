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
        // 刪除資料表
        Schema::dropIfExists('feed_backs');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('feed_backs', function (Blueprint $table) {
            //
        });
    }
};
