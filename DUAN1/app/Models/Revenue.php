<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revenue extends Model
{
    use HasFactory;
    protected $table = 'revenues'; // Tên bảng trong cơ sở dữ liệu
    protected $fillable = ['amount', 'created_at']; // Các cột có thể gán giá trị
}
