<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;


    protected $fillable = [
        'ma_san_pham',
        'ten_san_pham',
        'image',
        'so_luong',
        'category_id',
        'publisher_id',
        'author_id',
        'gia_san_pham',
        'gia_khuyen_mai',
        'mo_ta',
        'ngay_nhap'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
    public function imageProduct(){
        return $this->hasMany(image_product::class);
    }
}
