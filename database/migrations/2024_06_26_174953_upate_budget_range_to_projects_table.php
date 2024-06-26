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
        Schema::table('projects', function (Blueprint $table) {
            $table->enum('budget_range', ['預算另議', '1~3 萬', '3~5 萬', '6~9 萬', '10~15萬', '15~20萬', '20~25萬', '25~30萬', '40~50萬', '50~60萬', '60~70萬', '70~80萬', '80~90萬', '90~100萬', '100萬（含）以上'])->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            //
        });
    }
};
