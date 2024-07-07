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
            $table->text('work_content')->nullable()->comment('專案類別')->change();
            $table->string('schedule')->nullable()->comment('配合時間')->change();
            $table->string('location')->nullable()->comment('配合地點')->change();
            $table->string('budget')->nullable()->comment('專案預算')->change();
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
