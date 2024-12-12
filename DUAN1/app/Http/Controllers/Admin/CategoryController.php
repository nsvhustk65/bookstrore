<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::get();
        return view('admins.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admins.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $param =  $request->validate([
            'name' => 'required|max:255',
            'mo_ta' => 'required',
        ]);
        $param['trang_thai'] = $request->trang_thai ? 1 : 0;
        Category::create($param);
        return redirect()->route('admins.categories.index')->with('success', 'Thêm Mới Danh Mục Thành Công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return redirect()->route('admins.categories.index')->with('error', 'Danh mục không tồn tại!');
        }
        return view('admins.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return redirect()->route('admins.categories.index')->with('error', 'Danh Mục Không Tồn Tại!');
        }

        // Validate dữ liệu gửi lên từ form
        $param = $request->validate([
            'name' => 'required|max:255',
            'mo_ta' => 'required', // đảm bảo có trường mô tả
            'trang_thai' => 'required|in:0,1'
        ]);

        // Thực hiện cập nhật
        $category->update($param);

        return redirect()->route('admins.categories.index')->with('success', 'Cập Nhật Danh Mục Thành Công!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return redirect()->route('admins.categories.index')->with('error', 'Danh Mục Không Tồn Tại!');
        }
        if (Category::find($id)->products->count() > 0) {
            return redirect()->route('admins.categories.index')
                ->with('error', 'Category được sử dụng trong các sản phẩm. Bạn không thể xóa nó.');
        }
        $category->delete();
        return redirect()->route('admins.categories.index')->with('success', 'Xóa Danh Mục Thành Công!');
    }
    public function categoryByProduct(string $id)
    {

        $category = Product::where('category_id', $id)->get();

        return view('admins.product.categoryByProduct', compact('category'));
    }
}
