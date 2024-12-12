@extends('client.layouts.master')

@section('content')
    <div class="new-book-area pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title bt text-center pt-100 mb-30 section-title-res">
                        <h2>Danh sách sản phẩm</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($allProducts as $item)
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
                                        <li class="old-price">{{ number_format($item->gia_san_pham, 0, ',', '.') }} đ</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-link">
                                <div class="product-button">
                                     <form action="{{route('addCart')}}" method="POST">
                                            @csrf
                                             <input type="hidden" id="quantity" name="quantity" value="1" >
                                             <input type="hidden" name="id" value="{{ $item->id }}">
                                                <input type="hidden" name="ten_san_pham" value="{{ $item->ten_san_pham }}">
                                                <input type="hidden" name="price" value="{{ $item->gia_khuyen_mai }}">
                                                <input type="hidden" name="image" value="{{ $item->image }}">
                                            <button type="submit" title="Add to cart"><i class="fa fa-shopping-cart"></i>Add tocart</button>
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
    <style>
        .product-button {
            display: flex;
            justify-content: center;
            /* Căn giữa theo chiều ngang */
            align-items: center;
            /* Căn giữa theo chiều dọc */
            margin-top: 10px;
            /* Khoảng cách từ các phần tử phía trên */
        }

        .product-button button {
            background-color: #d3d3d3;
            /* Màu xám nhạt */
            color: #333;
            /* Màu chữ đen */
            padding: 10px 20px;
            /* Khoảng cách xung quanh chữ */
            font-size: 16px;
            /* Kích thước chữ */
            border: none;
            /* Không viền */
            border-radius: 5px;
            /* Bo góc */
            cursor: pointer;
            /* Thêm con trỏ khi hover */
            transition: all 0.3s ease;
            /* Hiệu ứng chuyển động mượt mà */
        }

        .product-button button:hover {
            background-color: #aaa;
            /* Màu xám đậm hơn khi hover */
            color: #fff;
            /* Màu chữ trắng khi hover */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            /* Hiệu ứng đổ bóng khi hover */
        }

        .product-button button:focus {
            outline: none;
            /* Xóa đường viền khi nhấn vào */
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

        .bestseller-img {
            height: 300px;
            /* Tăng chiều cao */
            width: 100%;
            /* Đảm bảo hình ảnh bao phủ toàn bộ chiều rộng */
            overflow: hidden;
            /* Để không bị vượt khung */
        }

        .bestseller-img img {
            width: 100%;
            /* Tăng độ rộng ảnh */
            height: 100%;
            /* Đảm bảo ảnh khớp với khung */
            object-fit: cover;
            /* Cắt ảnh để vừa khung */
        }

        .bestseller-text {
            padding: 15px;
            /* Tăng khoảng cách nội dung bên trong */
            font-size: 1rem;
            /* Tăng kích thước chữ */
            line-height: 1.5;
            /* Tăng khoảng cách giữa các dòng */
        }

        .price ul li {
            font-size: 1.2rem;
            /* Tăng kích thước giá */
        }

        .bestseller-text h3 a {
            font-size: 1re;
        }
    </style>
@endsection
