<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Đảm bảo cột payment_status có thể chứa trạng thái "Đã hủy"
            $table->string('payment_status', 50)->default('Chưa thanh toán')->change();
        });

        // Cập nhật trạng thái "Đã hủy" nếu điều kiện hợp lệ
        DB::table('orders')->where('trang_thai_don_hang', 'Đã hủy')->update(['payment_status' => 'Đã hủy']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Nếu rollback, giữ lại các trạng thái ban đầu
            $table->enum('payment_status', ['Đã thanh toán', 'Chưa thanh toán'])->default('Chưa thanh toán')->change();
        });

        // Đặt lại trạng thái "Đã hủy" về "Chưa thanh toán" khi rollback
        DB::table('orders')->where('payment_status', 'Đã hủy')->update(['payment_status' => 'Chưa thanh toán']);
    }
};
