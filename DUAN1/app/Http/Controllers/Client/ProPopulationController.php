<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProPopulationController extends Controller
{
    public function index()
    {
        $allProducts = Product::all();
        return view('client.layouts.partials.population', compact('allProducts'));
    }
}
