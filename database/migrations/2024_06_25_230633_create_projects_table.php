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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment('用户ID');
            $table->string('name')->comment('專案名稱');
            $table->string('contact_person')->comment('聯絡人');
            $table->string('phone')->nullable()->comment('電話號碼');
            $table->string('mobile')->nullable()->comment('手機號碼');
            $table->string('email')->comment('電子信箱');
            $table->string('department')->nullable()->comment('聯絡人所屬部門');
            $table->string('title')->nullable()->comment('聯絡人職稱');
            $table->text('description')->comment('內容');
            $table->text('work_content')->comment('工作內容');
            $table->string('schedule')->comment('配合時間');
            $table->string('location')->comment('配合地點');
            $table->string('budget')->comment('專案預算');
            $table->text('notes')->nullable()->comment('注意事項');
            $table->date('start_date')->comment('案件起始日期');
            $table->date('inquiry_deadline')->comment('洽詢期限');
            $table->text('required_skills')->comment('要求技能');
            $table->enum('budget_range', ['預算另議', '1~3 萬', '3~5 萬', '6~9 萬', '10~15萬', '15~20萬', '20~25', '25~30', '40~50', '50~60', '60~70', '70~80', '80~90', '90~100', '100（含）以上'])->comment('案件預算範圍');
            $table->string('target_audience')->comment('發案對象');
            $table->enum('work_location', ['皆可', '自備場所', '駐點'])->comment('自備場所');
            $table->integer('status')->comment('案件發佈狀態: 1: 公佈, 0:關閉專案');
            $table->integer('experience_years')->comment('經驗要求年限');
            $table->string('issuer_website')->nullable()->comment('發案者公司或個人網站');
            $table->timestamps();

            // 设置外键约束
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
