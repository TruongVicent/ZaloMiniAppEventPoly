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
        Schema::create('software_project', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Tên dự án');
            $table->integer('members')->comment('Số lượng thành viên tham gia');
            $table->integer('level')->comment('Cấp độ của dự án');
            $table->string('progress')->comment('Tiến độ hoàn thành');
            $table->date('star_date')->comment('Ngày bắt đầu');
            $table->date('end_date')->comment('Ngày kết thúc');
            $table->text('content')->comment('Nội dung dự án');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('software_project');
    }
};
