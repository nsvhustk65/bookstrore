<?php

namespace App\Http\Controllers\Admin;

use App\Models\Publisher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $listPublisher = Publisher::get();
        return view('admins.publisher.index', compact('listPublisher'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admins.publisher.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 
        $param = $request->validate([
            'name' => 'required| string | max:255',
            'address' => 'required| string | max:255',
            'phone' => 'required| string | max:255',
        ]);

        Publisher::create($param);

        return redirect()->route('admins.publishers.index')
            ->with('success', 'Publisher created successfully.');
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
        if (!Publisher::find($id)) {
            return redirect()->route('publishers.index')
                ->with('error', 'Publisher không tìm thấy.');
        }
        $publisher = Publisher::find($id);
        return view('admins.publisher.edit', compact('publisher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
             'name' => 'required| string | max:255',
            'address' => 'required| string | max:255',
            'phone' => 'required| string | max:255',
        ]);

        Publisher::find($id)->update($request->all());

        return redirect()->route('admins.publishers.index')
            ->with('success', 'Publisher cập nhật thành công.');     
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        if (Publisher::find($id)->products->count() > 0) {
            return redirect()->route('admins.publishers.index')
            ->with('error', 'Publisher được sử dụng trong các sản phẩm. Bạn không thể xóa nó.');
        }
        Publisher::find($id)->delete();
        return redirect()->route('admins.publishers.index');
    }
}
