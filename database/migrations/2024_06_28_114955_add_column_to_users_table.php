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
            $table->string('address')->nullable()->comment('地址');
            $table->integer('county_id')->nullable()->comment('縣市');
            $table->string('mobile')->nullable()->comment('電話');
            $table->string('avatar')->nullable()->comment('頭像');
            $table->string('introduction')->nullable()->comment('簡介');
            $table->integer('status')->default(1)->comment('狀態: 0:停用, 1:啟用');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
