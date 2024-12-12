<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Đổi enum của cột payment_status sang giá trị tiếng Việt
            $table->enum('payment_status', ['Đã thanh toán', 'Chưa thanh toán'])
                  ->default('Chưa thanh toán')
                  ->change();
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Khôi phục lại giá trị cũ
            $table->enum('payment_status', ['paid', 'unpaid'])
                  ->default('unpaid')
                  ->change();
        });
    }
};
