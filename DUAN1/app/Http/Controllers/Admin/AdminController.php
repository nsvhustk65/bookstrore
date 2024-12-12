<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function statistical()
    {
        $monthlyRevenue = DB::table('order_details')
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->selectRaw('MONTH(orders.created_at) as month, YEAR(orders.created_at) as year, SUM(order_details.thanh_tien) as total_revenue')
            ->groupByRaw('YEAR(orders.created_at), MONTH(orders.created_at)')
            ->orderByRaw('YEAR(orders.created_at), MONTH(orders.created_at)')
            ->get();
        $topProducts = DB::table('order_details')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->select(
                'products.id',
                'products.ten_san_pham',
                DB::raw('SUM(order_details.so_luong) as total_quantity'),
                DB::raw('SUM(order_details.thanh_tien) as total_revenue')
            )
            ->groupBy('products.id', 'products.ten_san_pham')
            ->orderByDesc('total_quantity')
            ->limit(5)
            ->get();
        return view('admins.statistical', compact('monthlyRevenue', 'topProducts'));
    }
}
