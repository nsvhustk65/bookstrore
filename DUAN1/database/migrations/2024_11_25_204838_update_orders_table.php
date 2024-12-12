<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Chuẩn hóa dữ liệu cũ trước khi thay đổi kiểu enum
        DB::table('orders')
            ->whereNotIn('trang_thai_don_hang', [
                'Chờ xử lý', 'Đang Đóng Hàng', 'Đang vận chuyển', 'Đã giao hàng', 'Hoàn thành', 'Đã hủy'
            ])
            ->update(['trang_thai_don_hang' => 'Chờ xử lý']);

        // Cập nhật cột trang_thai_don_hang
        Schema::table('orders', function (Blueprint $table) {
            $table->enum('trang_thai_don_hang', [
                'Chờ xử lý',
                'Đang Đóng Hàng',
                'Đang vận chuyển',
                'Đã giao hàng',
                'Hoàn thành',
                'Đã hủy'
            ])->default('Chờ xử lý')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('trang_thai_don_hang')->change();
        });
    }
};
