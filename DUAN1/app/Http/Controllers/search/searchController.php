<?php

namespace App\Http\Controllers\search;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class searchController extends Controller
{
    //
    public function searchProducts(Request $request)
    {
        $request->validate([
            'search' => 'required|string|min:3|max:30'
        ], [
            'search.required' => 'Vui lòng nhập từ khóa tìm kiếm!',
            'search.min' => 'Từ khóa không được nhỏ hơn 3 ký tự!',
            'search.max' => 'Từ khóa không được nhiều hơn 30 ký tự!',
        ]);
        $search = $request->input('search');
        $products = Product::where('ma_san_pham', 'LIKE', "%{$search}%")
            ->orWhere('ten_san_pham', 'LIKE', "%{$search}%")
            ->orWhere('image', 'LIKE', "%{$search}%")
            ->orWhere('so_luong', 'LIKE', "%{$search}%")
            ->orWhere('category_id', 'LIKE', "%{$search}%")
            ->orWhere('publisher_id', 'LIKE', "%{$search}%")
            ->orWhere('author_id', 'LIKE', "%{$search}%")
            ->orWhere('gia_san_pham', 'LIKE', "%{$search}%")
            ->orWhere('gia_khuyen_mai', 'LIKE', "%{$search}%")
            ->orWhere('mo_ta', 'LIKE', "%{$search}%")
            ->orWhere('ngay_nhap', 'LIKE', "%{$search}%")
            ->get();

        // Kiểm tra kết quả
        // if ($products->isEmpty()) {
        //     return back()->withErrors(['search' => 'Không có sản phẩm nào phù hợp với từ khóa.']);
        // }
        return view('client.layouts.partials.search', compact('products', 'search'));
    }
}
