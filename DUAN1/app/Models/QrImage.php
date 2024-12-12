<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QrImage extends Model
{
    use HasFactory;

    protected $fillable = ['qr_code','status',];
    public function scopeVisible($query)
    {
        return $query->where('status', 1);
    }
    // Đảm bảo chỉ định các trường có thể được gán hàng loạt

    // Nếu cần thêm phương thức để xử lý ảnh, bạn có thể thêm ở đây
}

