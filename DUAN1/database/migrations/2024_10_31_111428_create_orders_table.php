<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('ma_don_hang');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('ten_nguoi_nhan');
            $table->string('phone_nguoi_nhan');
            $table->string('email_nguoi_nhan');
            $table->string('address_nguoi_nhan');
            $table->double('tien_hang')->nullable();  // Cho phép giá trị null
            $table->double('tien_ship')->nullable();
            $table->double('tong_tien');
            $table->text('ghi_chu')->nullable();
            $table->string('trang_thai_don_hang');
            $table->enum('trang_thai_thanh_toan', ['COD', 'Online'])->nullable();

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
