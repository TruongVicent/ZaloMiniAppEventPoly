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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('name_student')->comment('Họ tên học sinh');
            $table->string('code_student')->comment('Mã số sinh viên');
            $table->string('email')->comment('Email sinh viên');
            $table->text('content_support')->comment('Vấn đề cần hỗ trợ');
            $table->text('problem_support')->nullable()->comment('Nội dung Đã hỗ trợ vẫn đề');
            $table->string('who_support')->nullable()->comment('Người hỗ trợ');
            $table->dateTime('supported_at')->nullable()->comment('Ngày giờ đã hỗ trợ');
            $table->enum('status',['new','resolved'])->default('new')->comment('Có 2 trạng thái cho ticket');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
