@extends('client.layouts.master')
@section('content')
    <div class="container">
        <h2>Kết quả tìm kiếm cho: "{{ $search }}"</h2>
        @if ($products->count() > 0)
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <img src="{{ Storage::url($product->image) }}" class="card-img-top" alt="{{ $product->ten_san_pham }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->ten_san_pham }}</h5>
                                <p class="card-text">{{ $product->mo_ta }}</p>
                                {{-- <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary">Chi tiết</a> --}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>Không có sản phẩm nào phù hợp với từ khóa "{{ $search }}".</p>
        @endif
    </div>
@endsection
