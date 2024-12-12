<?php

namespace App\Http\Controllers\Admin;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $listBanner = Banner::get();
        return view('admins.banner.index', compact('listBanner'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admins.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $param = $request->validate([
            'image' =>'required|image|max:2048',
            'title' =>'required|max:255',
        ]);

        $param['image'] = $request->file('image')->store('uploads/product', 'public');

        Banner::create($param);

        return redirect()->route('admins.banner.index')->with('success', 'Thêm mới thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $banner = Banner::find($id);
        if (!$banner) {
            return redirect()->route('admins.banner.index')->with('error', 'Banner không tồn tại!');
        }
        return view('admins.banner.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $banner = Banner::find($id);
        if (!$banner) {
            return redirect()->route('admins.banner.index')->with('error', 'Banner không tồn tại!');
        }

        $param = $request->validate([
            'title' =>'required|max:255',
        ]);
        if ($request->hasFile('image')) {
            $param['image'] = $request->file('image')->store('uploads/product', 'public');
    }
    $banner->update($param);
    return redirect()->route('admins.banner.index')->with('success', 'Cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $banner = Banner::find($id);
        if (!$banner) {
            return redirect()->route('admins.banner.index')->with('error', 'Banner không tồn tại!');
        }
        $banner->delete();
        return redirect()->route('admins.banner.index')->with('success', 'Xóa thành công!');
    }
}
