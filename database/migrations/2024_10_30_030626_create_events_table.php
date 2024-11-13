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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Tên sự kiện');
            $table->string('image')->comment('Ảnh sự kiện');
            $table->text('content')->comment('Nội dung sự kiện');
            $table->foreignIdFor(\App\Models\EventType::class)->comment('Loại sự kiện');
            $table->dateTime('start_time')->comment('Thời gian bắt đầu');
            $table->string('taget_audience')->comment('Đối tượng hướng đến');
            $table->string('address')->comment('Địa chỉ')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
