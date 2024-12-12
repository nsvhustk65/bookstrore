<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    use HasFactory;

    // Đặt tên bảng nếu khác với tên mặc định
    protected $table = 'password_resets';

    // Các thuộc tính có thể được gán hàng loạt
    protected $fillable = [
        'email',
        'token',
        'created_at',
    ];

    // Nếu bạn không muốn Laravel tự động quản lý timestamps
    // public $timestamps = false;

    // Nếu bạn muốn tùy chỉnh các trường timestamps
    // const CREATED_AT = 'created_at';
    // const UPDATED_AT = null; // Nếu không sử dụng trường updated_at
}
