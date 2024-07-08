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
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->comment('姓名');
            $table->string('email')->nullable()->comment('電子郵件');
            $table->bigInteger('user_id')->nullable()->comment('使用者 ID');
            $table->enum('type', ['操作畫面問題', '功能請求', '錯誤報告', '性能問題', '用戶體驗問題', '其他'])->default('操作畫面問題')->comment('類型');
            $table->text('content')->nullable()->comment('意見');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedback');
    }
};
