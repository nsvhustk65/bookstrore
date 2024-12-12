<?php

namespace App\Http\Controllers\Client;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Support\Facades\DB;
use App\Models\OrderDetail;

class UserController extends Controller
{
    public function indexUser()
    {
        // Lấy 8 sản phẩm mới nhất
        $newestProducts = Product::orderBy('created_at', 'desc')->take(8)->get();

        // Lấy 10 sản phẩm bán chạy nhất (top 8 sản phẩm bán chạy)
        $topSellingProducts = OrderDetail::select('product_id', DB::raw('SUM(so_luong) as total_sold'))
            ->groupBy('product_id')
            ->orderByDesc('total_sold')  // Sắp xếp theo tổng số lượng bán giảm dần
            ->limit(8)  // Giới hạn 8 sản phẩm bán chạy nhất
            ->get();

        // Lấy thông tin chi tiết của các sản phẩm bán chạy
        $topSellingProductsDetails = Product::with('imageProduct') // Liên kết với quan hệ imageProduct để lấy ảnh
            ->whereIn('id', $topSellingProducts->pluck('product_id'))
            ->get(['id', 'ten_san_pham', 'gia_san_pham', 'gia_khuyen_mai', 'image']);  // Chọn các trường cần thiết

        // Lấy các sản phẩm khác để hiển thị
        $products = Product::orderBy('so_luong', 'desc')->take(10)->get();
        $allProducts = Product::all();
        $product_2 = Product::take(2)->get()->first();
        $product_1 = Product::orderBy('created_at', 'desc')->skip(1)->take(1)->first();
        $product_3 = Product::orderBy('created_at', 'desc')->skip(2)->take(1)->first();
        $product_4 = Product::orderBy('created_at', 'desc')->skip(3)->take(1)->first();

        $banner = Banner::get();

        return view('client.index', compact(
            'products', 'allProducts', 'product_2', 'product_1', 'product_3', 'product_4',
            'topSellingProductsDetails', 'newestProducts', 'banner'
        ));
    }



    public function detailProduct(String $id)
    {
        $product = Product::find($id);
        $id_category = $product->category_id;
        $products11 = Product::where('category_id', $id_category)
            ->orderBy('created_at', 'desc')
            ->take(3)->get();
        $productSoLuong = Product::orderBy('so_luong', 'desc')->take(3)->get();
        return view('client.layouts.partials.product-detail', compact('product', 'products11', 'productSoLuong'));
    }
    public function loginUser(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không đúng định dạng.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
        ]);
    }
}
