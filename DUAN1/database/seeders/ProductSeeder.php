<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run()
    {
        DB::table('products')->insert([
            [
                'ma_san_pham' => 'SP001',
                'ten_san_pham' => 'Sách Kỹ Năng Sống',
                'image' => 'images/sach_ky_nang_song.jpg',
                'so_luong' => 100,
                'category_id' => 1,
                'publisher_id' => 2,
                'author_id' => 3,
                'gia_san_pham' => 150000,
                'gia_khuyen_mai' => 120000,
                'mo_ta' => 'Cuốn sách cung cấp các kỹ năng cần thiết trong cuộc sống.',
                'ngay_nhap' => '2024-11-15',
            ],
            [
                'ma_san_pham' => 'SP002',
                'ten_san_pham' => 'Tiểu Thuyết Hành Động',
                'image' => 'images/tieu_thuyet_hanh_dong.jpg',
                'so_luong' => 50,
                'category_id' => 2,
                'publisher_id' => 1,
                'author_id' => 4,
                'gia_san_pham' => 200000,
                'gia_khuyen_mai' => 180000,
                'mo_ta' => 'Một câu chuyện hấp dẫn và kịch tính.',
                'ngay_nhap' => '2024-11-16',
            ],
            [
                'ma_san_pham' => 'SP003',
                'ten_san_pham' => 'Sách Lịch Sử Việt Nam',
                'image' => 'images/lich_su_viet_nam.jpg',
                'so_luong' => 75,
                'category_id' => 3,
                'publisher_id' => 3,
                'author_id' => 5,
                'gia_san_pham' => 250000,
                'gia_khuyen_mai' => 220000,
                'mo_ta' => 'Khám phá lịch sử Việt Nam qua các thời kỳ.',
                'ngay_nhap' => '2024-11-14',
            ],
            [
                'ma_san_pham' => 'SP004',
                'ten_san_pham' => 'Truyện Cổ Tích',
                'image' => 'images/truyen_co_tich.jpg',
                'so_luong' => 120,
                'category_id' => 4,
                'publisher_id' => 2,
                'author_id' => 6,
                'gia_san_pham' => 100000,
                'gia_khuyen_mai' => 90000,
                'mo_ta' => 'Tuyển tập truyện cổ tích Việt Nam và thế giới.',
                'ngay_nhap' => '2024-11-13',
            ],
            [
                'ma_san_pham' => 'SP005',
                'ten_san_pham' => 'Sách Học Ngoại Ngữ',
                'image' => 'images/sach_hoc_ngoai_ngu.jpg',
                'so_luong' => 80,
                'category_id' => 5,
                'publisher_id' => 1,
                'author_id' => 7,
                'gia_san_pham' => 180000,
                'gia_khuyen_mai' => 160000,
                'mo_ta' => 'Học tiếng Anh giao tiếp dễ dàng và hiệu quả.',
                'ngay_nhap' => '2024-11-12',
            ],
        ]);
    }
}
