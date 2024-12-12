<?php

namespace App\Http\Controllers\Admin;

use App\Models\Author;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $listAuthor = Author::get();
        return view('admins.author.index', compact('listAuthor'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admins.author.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $param = $request->validate([
            'name' => 'required|max:255',
            'bio' => 'required',
        ]);;
        Author::create($param);
        return redirect()->route('admins.authors.index')->with('success', 'Thêm mới tác giả thành công');
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
        if (!Author::find($id)) {
            return redirect()->route('admins.authors.index')->with('error', 'Tác giả không  tồn tại');
            };
        $author = Author::find($id);
        return view('admins.author.edit', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $param = $request->validate([
            'name' => 'required|max:255',
            'bio' => 'required',
        ]);;
        Author::find($id)->update($param);
        return redirect()->route('admins.authors.index')->with('success', 'Cập nhật tác giả thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        if (!Author::find($id)) {
            return redirect()->route('admins.authors.index')->with('error', 'Tác giả không tồn tại');
        }
         if (Author::find($id)->products->count() > 0) {
            return redirect()->route('admins.authors.index')
            ->with('error', 'Publisher được sử dụng trong các sản phẩm. Bạn không thể xóa nó.');
        }
        Author::find($id)->delete();
        return redirect()->route('admins.authors.index')->with('success', 'Xóa tác giả thành công');
    }
}
