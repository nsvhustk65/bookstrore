<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'ma_don_hang',
        'user_id',
        'ten_nguoi_nhan',
        'phone_nguoi_nhan',
        'email_nguoi_nhan',
        'address_nguoi_nhan',
        'tien_hang',
        'tien_ship',
        'tong_tien',
        'ghi_chu',
        'trang_thai_don_hang',
        'trang_thai_thanh_toan',
        'payment_status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function OrderDetail()
    {
        return $this->hasMany(OrderDetail::class,'order_id');
    }
}
