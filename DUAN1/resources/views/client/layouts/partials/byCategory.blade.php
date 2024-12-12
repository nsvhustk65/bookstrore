@extends('client.layouts.master')
@section('content')
    <style>
        /* Căn giữa nội dung các ô trong bảng */
        .table td,
        .table th {
            vertical-align: middle;
            text-align: center;
        }

        /* Đặt khoảng cách giữa các nút trong cột hành động */
        .table .d-flex .btn {
            margin: 0 5px;
        }

        .product-img img {
            width: 100%;
            height: 250px;
            /* Chiều cao cố định cho tất cả hình ảnh, bạn có thể điều chỉnh tùy ý */
            object-fit: cover;
            /* Giúp hình ảnh giữ tỷ lệ mà không bị biến dạng */
            border-radius: 8px;
            /* Tùy chọn: Bo tròn các góc ảnh */
        }
    </style>

    <div class="content">
        <div class="new-book-area pb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title bt text-center pt-100 mb-30 section-title-res">
                            <h2>{{ $namecategory->name }}</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($category as $item)
                        <div class="col-sm-3">
                            <div class="tab-total">
                                <!-- single-product-start -->
                                <div class="product-wrapper ">
                                    <div class="product-img">
                                        <a href="{{ route('detailProduct', $item->id) }}">
                                            <img src="{{ Storage::url($item->image) }}" alt="book" class="primary" />
                                        </a>

                                    </div>
                                    <div class="product-details text-center">
                                        <div class="product-rating">
                                            <ul>
                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                            </ul>
                                        </div>
                                        <h4><a href="{{ route('detailProduct', $item->id) }}">{{ $item->ten_san_pham }}</a></h4>
                                        <div class="product-price">
                                            <ul>
                                                <li>{{ number_format($item->gia_khuyen_mai, 0, ',', '.') }} đ</li>
                                                <li class="old-price">{{ number_format($item->gia_san_pham, 0, ',', '.') }} đ
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-link">
                                        <div class="product-button">
                                            <form action="{{ route('addCart') }}" method="POST">
                                                @csrf
                                                <input type="hidden" id="quantity" name="quantity" value="1">
                                                <input type="hidden" name="id" value="{{ $item->id }}">
                                                <input type="hidden" name="ten_san_pham" value="{{ $item->ten_san_pham }}">
                                                <input type="hidden" name="price" value="{{ $item->gia_khuyen_mai }}">
                                                <input type="hidden" name="image" value="{{ $item->image }}">
                                                <button type="submit" title="Add to cart"><i
                                                        class="fa fa-shopping-cart"></i>Add tocart</button>
                                            </form>
                                        </div>
                                        <div class="add-to-link">
                                            <ul>
                                                <li><a href="{{ route('detailProduct', $item->id) }}" title="Details"><i
                                                            class="fa fa-external-link"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- single-product-end -->
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
@endsection
