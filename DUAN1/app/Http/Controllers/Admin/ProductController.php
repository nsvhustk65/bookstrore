<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Author;
use App\Models\Category;
use App\Models\image_product;
use App\Models\Product;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Lấy tất cả sản phẩm, sắp xếp theo ngày tạo (mới nhất lên đầu) và phân trang với 10 sản phẩm mỗi trang
        $listProduct = Product::orderBy('created_at', 'desc')->paginate(10);

        // Trả về view với dữ liệu sản phẩm
        return view('admins.product.index', compact('listProduct'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $listCategory = Category::get();
        $listPublisher = Publisher::get();
        $listAuthor = Author::get();
        return view('admins.product.create', compact('listCategory', 'listPublisher', 'listAuthor'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        //
        $param = $request->except('_token');
        if ($request->hasFile('image')) {
            $param['image'] = $request->file('image')->store('uploads/product', 'public');
        } else {
            $param['image'] = '';
        }
        $product = Product::create($param);
        $productId = $product->id;
        if ($request->hasFile('list_hinh_anh')) {
            foreach ($request->file('list_hinh_anh') as $image) {
                if ($image) {
                    $path = $image->store('uploads/albumproduct/id-' . $productId, 'public');
                    $product->imageProduct()->create([
                        'product_id' => $productId,
                        'image' => $path
                    ]);
                }
            }
        }
        return redirect()->route('admins.products.index')->with('success', 'thêm mới thành công');
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
        //
        $listCategory = Category::get();
        $listPublisher = Publisher::get();
        $listAuthor = Author::get();
        $listProduct = Product::find($id);
        return view('admins.product.edit', compact('listCategory', 'listPublisher', 'listAuthor', 'listProduct'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        $param = $request->except('_token', '_method');
        $product = Product::find($id);

        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $param['image'] = $request->file('image')->store('uploads/product', 'public');
        } else {
            $param['image'] = $product->image;
        }

        // Xử lý album nếu có hình ảnh trong list_hinh_anh
        if ($request->has('list_hinh_anh') && is_array($request->list_hinh_anh)) {
            $currentImages = $product->imageProduct->pluck('id')->toArray();
            $arrayCombine = array_combine($currentImages, $currentImages);

            foreach ($arrayCombine as $key => $values) {
                // Kiểm tra hình ảnh hiện tại có còn trong danh sách mới không
                if (!array_key_exists($key, $request->list_hinh_anh)) {
                    $imageProduct = image_product::find($key);
                    // Xóa hình ảnh nếu tồn tại
                    if ($imageProduct && $imageProduct->image && Storage::disk('public')->exists($imageProduct->image)) {
                        Storage::disk('public')->delete($imageProduct->image);
                        $imageProduct->delete();
                    }
                }
            }

            // Trường hợp thêm hoặc sửa hình ảnh album
            foreach ($request->list_hinh_anh as $key => $image) {
                if (!array_key_exists($key, $arrayCombine)) {
                    if ($request->hasFile("list_hinh_anh.$key")) {
                        $path = $image->store('uploads/albumproduct/id-' . $id, 'public');
                        $product->imageProduct()->create([
                            'product_id' => $id,
                            'image' => $path
                        ]);
                    }
                } else if (is_file($image) && $request->hasFile("list_hinh_anh.$key")) {
                    $imageProduct = image_product::find($id);
                    if ($imageProduct && Storage::disk('public')->exists($imageProduct->image)) {
                        Storage::disk('public')->delete($imageProduct->image);
                    }
                    $path = $image->store('uploads/albumproduct/id-' . $id, 'public');
                    $imageProduct->update([
                        'image' => $path
                    ]);
                }
            }
        }

        $product->update($param);

        return redirect()->route('admins.products.index')->with('success', 'Sửa Thành Công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $product = Product::find($id);

        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->imageProduct()->delete();
        $path = 'uploads/albumproduct/id_' . $id;
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->deleteDirectory($path);
        }
        $product->delete();
        return redirect()->route('admins.products.index')->with('success', 'Xóa Thành Công');
    }
}
