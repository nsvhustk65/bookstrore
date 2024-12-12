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
        Schema::create('qr_images', function (Blueprint $table) {
            $table->id();  // Tạo trường id tự động tăng
            $table->string('qr_code');  // Lưu tên ảnh QR
            $table->timestamps();  // Thêm created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('qr_images');
    }
};
