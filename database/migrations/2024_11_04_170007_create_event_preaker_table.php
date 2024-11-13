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
        Schema::create('event_preaker', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(\App\Models\Event::class) // Sử dụng foreignIdFor cho bảng events
            ->constrained()
                ->onDelete('cascade');
            $table->foreignIdFor(\App\Models\Preaker::class) // Sử dụng foreignIdFor cho bảng preakers
            ->constrained()
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_preaker');
    }
};
