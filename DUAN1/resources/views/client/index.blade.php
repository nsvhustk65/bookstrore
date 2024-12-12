@extends('client.layouts.master')

@section('content')

    <style>
        .single-slider {
            padding-top: 150px;
            /* Tăng khoảng cách trên */
            padding-bottom: 150px;
            /* Tăng khoảng cách dưới */
            background-size: cover;
            /* Đảm bảo hình ảnh phủ hết vùng chứa */
            background-position: center;
            /* Căn giữa hình ảnh */
            background-repeat: no-repeat;
            /* Không lặp lại ảnh */
        }

        @media (max-width: 768px) {
            .single-slider {
                padding-top: 100px;
                /* Điều chỉnh lại trên màn hình nhỏ hơn */
                padding-bottom: 100px;
            }
        }

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

        .custom-alert {
            position: fixed;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            z-index: 9999;
            /* Đảm bảo thông báo luôn hiển thị trên các phần tử khác */
            margin: 10px 0;
            width: 80%;
            max-width: 500px;
            text-align: center;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            font-size: 16px;
            padding: 10px;
            opacity: 1;
            visibility: visible;
            transition: opacity 0.5s, visibility 0s 0.5s;
            /* Hiệu ứng mờ dần khi ẩn */
        }

        .alert-dismissible .btn-close {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        /* CSS để ẩn thông báo khi cần */
        .custom-alert.hide {
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.5s, visibility 0s 0s;
            /* Ẩn thông báo với hiệu ứng mờ dần */
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Tìm tất cả các thông báo có lớp "custom-alert"
            var alerts = document.querySelectorAll('.custom-alert');

            alerts.forEach(function (alert) {
                // Set timeout để ẩn thông báo sau 5 giây
                setTimeout(function() {
                    alert.classList.add('hide');
                }, 5000); // 5000ms = 5 giây
            });
        });
    </script>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show custom-alert" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show custom-alert" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <!-- banner-area-end -->
    <!-- slider-area-start -->
    <div class="slider-area">
        <div class="slider-active owl-carousel">

            @foreach ($banner as $item)
                <div class="single-slider pt-125 pb-130 bg-img"
                    style="background-image:url('{{ Storage::url($item->image) }}');">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="slider-content slider-animated-1 text-center">
                                    <h1>{{ $item->title }}</h1>
                                    {{-- <h2>koparion</h2>
                                <h3>Now starting at £99.00</h3>
                                <a href="#">Shop now</a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="banner-area banner-res-large pt-30 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="single-banner mb-30">
                        <div class="banner-img">
                            <a href="#"><img src="/client/img/banner/1.png" alt="banner" /></a>
                        </div>
                        <div class="banner-text">
                            <h4>Đồng giá phí ship</h4>
                            <p>Phí ship chỉ với 20000 VNĐ</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="single-banner mb-30">
                        <div class="banner-img">
                            <a href="#"><img src="/client/img/banner/2.png" alt="banner" /></a>
                        </div>
                        <div class="banner-text">
                            <h4>Đảm bảo hoàn tiền</h4>
                            <p>Hoàn tiền 100% với tất cả sản phẩm lỗi</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="single-banner mb-30">
                        <div class="banner-img">
                            <a href="#"><img src="/client/img/banner/3.png" alt="banner" /></a>
                        </div>
                        <div class="banner-text">
                            <h4>Thanh toán khi nhận hàng</h4>
                            <p>Kiểm tra hàng trước khi thanh toán</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="single-banner mb-30">
                        <div class="banner-img">
                            <a href="#"><img src="/client/img/banner/4.png" alt="banner" /></a>
                        </div>
                        <div class="banner-text">
                            <h4>Hỗ trợ và Giúp đỡ</h4>
                            <p>Liên hệ : + 0123.4567.89</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- banner-area-end -->
    <div class="new-book-area pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title bt text-center pt-100 mb-30 section-title-res">
                        <h2>Sản phẩm mới</h2>
                    </div>
                </div>
            </div>

            <div class="tab-active owl-carousel">
                @if ($newestProducts->isNotEmpty())
                    @foreach ($newestProducts as $item)
                        <div class="tab-total">
                            <!-- single-product-start -->
                            <div class="product-wrapper ">
                                <div class="product-img">
                                    <a href="{{ route('detailProduct', $item->id) }}">
                                        <img src="{{ Storage::url($item->image) }}" alt="book" class="primary" />
                                    </a>
                                    <div class="product-flag">
                                        <ul>
                                            <li><span class="sale">new</span> </li>
                                            <li><span class="discount-percentage">-5%</span></li>
                                        </ul>
                                    </div>
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
                                    <h4><a href="{{ route('detailProduct', $item->id) }}">{{ $item->ten_san_pham }}</a>
                                    </h4>
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
                                                    class="fa fa-shopping-cart"></i>Thêm vào giỏ</button>
                                        </form>
                                    </div>
                                    <div class="add-to-link">
                                        <ul>
                                            <li><a href="{{ route('detailProduct', $item->id) }}" title="Chi tiết"><i
                                                        class="fa fa-external-link"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- single-product-end -->
                        </div>
                    @endforeach
                @else
                    <p>Không có sản phẩm mới nào.</p>
                @endif
            </div>
        </div>
    </div>
    <!-- product-area-start -->
    <div class="new-book-area pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title bt text-center pt-100 mb-30 section-title-res">
                        <h2>Sản phẩm bán chạy</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($topSellingProductsDetails as $item)
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
                                    <h4><a href="{{ route('detailProduct', $item->id) }}">{{ $item->ten_san_pham }}</a>
                                    </h4>
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
    <!-- product-area-end -->
    <!-- banner-area-start -->
    <div class="banner-area-5 mtb-95">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="banner-img-2">
                        <a href="#"><img src="/client/img/banner/5.jpg" alt="banner" /></a>
                        <div class="banner-text">
                            <h3>G. Meyer Books & Spiritual Traveler Press</h3>
                            <h2>Sale up to 30% off</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- banner-area-end -->
    <!-- bestseller-area-start -->
    <div class="bestseller-area pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-12">
                    <div class="bestseller-content">
                        <h1>Author best selling</h1>
                        <h2>J. K. <br />Rowling</h2>
                        <p class="categories">categories:<a href="#">Books</a> , <a href="#">Audiobooks</a>
                        </p>
                        <p>Vestibulum porttitor iaculis gravida. Praesent vestibulum varius placerat. Cras tempor congue
                            neque, id aliquam orci finibus sit amet. Fusce at facilisis arcu. Donec aliquet nulla id
                            turpis semper, a bibendum metus vulputate. Suspendisse potenti. </p>
                        <div class="social-author">
                            <ul>
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="banner-img-2">
                        <a href="#"><img src="/client/img/banner/6.jpg" alt="banner" /></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-12">
                    <div class="row">
                        <!-- Sản phẩm 1 -->
                        <div class="col-md-6 mb-4">
                            <div class="single-bestseller">
                                <div class="bestseller-img">
                                    <a href="{{ route('detailProduct', $product_2->id) }}">
                                        <img src="{{ Storage::url($product_2->image) }}" alt="book" />
                                    </a>
                                    <div class="product-flag">
                                        <ul>
                                            <li><span class="sale">new</span></li>
                                            <li><span class="discount-percentage">-5%</span></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="bestseller-text text-center">
                                    <h3><a
                                            href="{{ route('detailProduct', $product_2->id) }}">{{ $product_2->ten_san_pham }}</a>
                                    </h3>
                                    <div class="price">
                                        <ul>
                                            <li><span
                                                    class="new-price">{{ number_format($product_2->gia_khuyen_mai, 0, ',', '.') }}
                                                    đ</span></li>
                                            <li><span
                                                    class="old-price">{{ number_format($product_2->gia_san_pham, 0, ',', '.') }}
                                                    đ</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sản phẩm 2 -->
                        <div class="col-md-6 mb-4">
                            <div class="single-bestseller">
                                <div class="bestseller-img">
                                    <a href="{{ route('detailProduct', $product_1->id) }}">
                                        <img src="{{ Storage::url($product_1->image) }}" alt="book" />
                                    </a>
                                    <div class="product-flag">
                                        <ul>
                                            <li><span class="sale">new</span></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="bestseller-text text-center">
                                    <h3><a
                                            href="{{ route('detailProduct', $product_1->id) }}">{{ $product_1->ten_san_pham }}</a>
                                    </h3>
                                    <div class="price">
                                        <ul>
                                            <li><span
                                                    class="new-price">{{ number_format($product_1->gia_khuyen_mai, 0, ',', '.') }}
                                                    đ</span></li>
                                            <li><span
                                                    class="old-price">{{ number_format($product_1->gia_san_pham, 0, ',', '.') }}
                                                    đ</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sản phẩm 3 -->
                        <div class="col-md-6 mb-4">
                            <div class="single-bestseller">
                                <div class="bestseller-img">
                                    <a href="{{ route('detailProduct', $product_2->id) }}">
                                        <img src="{{ Storage::url($product_2->image) }}" alt="book" />
                                    </a>
                                    <div class="product-flag">
                                        <ul>
                                            <li><span class="sale">new</span></li>
                                            <li><span class="discount-percentage">-5%</span></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="bestseller-text text-center">
                                    <h3><a
                                            href="{{ route('detailProduct', $product_2->id) }}">{{ $product_2->ten_san_pham }}</a>
                                    </h3>
                                    <div class="price">
                                        <ul>
                                            <li><span
                                                    class="new-price">{{ number_format($product_2->gia_khuyen_mai, 0, ',', '.') }}
                                                    đ</span></li>
                                            <li><span
                                                    class="old-price">{{ number_format($product_2->gia_san_pham, 0, ',', '.') }}
                                                    đ</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sản phẩm 4 -->
                        <div class="col-md-6 mb-4">
                            <div class="single-bestseller">
                                <div class="bestseller-img">
                                    <a href="{{ route('detailProduct', $product_1->id) }}">
                                        <img src="{{ Storage::url($product_1->image) }}" alt="book" />
                                    </a>
                                    <div class="product-flag">
                                        <ul>
                                            <li><span class="sale">new</span></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="bestseller-text text-center">
                                    <h3><a
                                            href="{{ route('detailProduct', $product_1->id) }}">{{ $product_1->ten_san_pham }}</a>
                                    </h3>
                                    <div class="price">
                                        <ul>
                                            <li><span
                                                    class="new-price">{{ number_format($product_1->gia_khuyen_mai, 0, ',', '.') }}
                                                    đ</span></li>
                                            <li><span
                                                    class="old-price">{{ number_format($product_1->gia_san_pham, 0, ',', '.') }}
                                                    đ</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- bestseller-area-end -->
    <!-- new-book-area-start -->



    <!-- new-book-area-start -->
    <!-- banner-static-area-start -->
    <div class="banner-static-area bg ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="banner-shadow-hover xs-mb">
                        <a href="#"><img src="/client/img/banner/8.jpg" alt="banner" /></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="banner-shadow-hover">
                        <a href="#"><img src="/client/img/banner/9.jpg" alt="banner" /></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="testimonial-area ptb-100 bg">
        <div class="container">
            <div class="row">
                <div class="testimonial-active owl-carousel">
                    <div class="col-lg-12">
                        <div class="single-testimonial text-center">
                            <div class="testimonial-img">
                                <a href="#"><i class="fa fa-quote-right"></i></a>
                            </div>
                            <div class="testimonial-text">
                                <p>I'm so happy with all of the themes, great support, could not wish for more. These
                                    people are <br /> geniuses ! Kudo's from the Netherlands !</p>
                                <a href="#">Sandy Wilcke/user</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="single-testimonial text-center">
                            <div class="testimonial-img">
                                <a href="#"><i class="fa fa-quote-right"></i></a>
                            </div>
                            <div class="testimonial-text">
                                <p>All Perfect !! I have three sites with magento , this theme is the best !! Excellent
                                    support ,<br /> advice theme installation package , sorry for English, are Italian
                                    but I had no problem !! Thank you !</p>
                                <a href="#">Sandy Wilcke/user</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- testimonial-area-end -->
    <!-- recent-post-area-start -->
    <div class="recent-post-area pt-95 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center mb-30 section-title-res">
                        <h2>Latest from our blog</h2>
                    </div>
                </div>
                <div class="post-active owl-carousel text-center">
                    <div class="col-lg-12">
                        <div class="single-post">
                            <div class="post-img">
                                <a href="#"><img src="/client/img/post/1.jpg" alt="post" /></a>
                                <div class="blog-date-time">
                                    <span class="day-time">06</span>
                                    <span class="moth-time">Dec</span>
                                </div>
                            </div>
                            <div class="post-content">
                                <h3><a href="#">Nam tincidunt vulputate felis</a></h3>
                                <span class="meta-author"> Demo koparion </span>
                                <p>Discover five of our favourite dresses from our new collection that are destined to
                                    be worn and loved immediately.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="single-post">
                            <div class="post-img">
                                <a href="blog-details.html"><img src="/client/img/post/2.jpg" alt="post" /></a>
                                <div class="blog-date-time">
                                    <span class="day-time">06</span>
                                    <span class="moth-time">Dec</span>
                                </div>
                            </div>
                            <div class="post-content">
                                <h3><a href="blog-details.html">Interdum et malesuada</a></h3>
                                <span class="meta-author"> Demo koparion </span>
                                <p>Discover five of our favourite dresses from our new collection that are destined to
                                    be worn and loved immediately.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="single-post">
                            <div class="post-img">
                                <a href="blog-details.html"><img src="/client/img/post/3.jpg" alt="post" /></a>
                                <div class="blog-date-time">
                                    <span class="day-time">07</span>
                                    <span class="moth-time">Dec</span>
                                </div>
                            </div>
                            <div class="post-content">
                                <h3><a href="blog-details.html">What is Bootstrap?</a></h3>
                                <span class="meta-author"> Demo koparion </span>
                                <p>Discover five of our favourite dresses from our new collection that are destined to
                                    be worn and loved immediately.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="single-post">
                            <div class="post-img">
                                <a href="blog-details.html"><img src="/client/img/post/4.jpg" alt="post" /></a>
                                <div class="blog-date-time">
                                    <span class="day-time">08</span>
                                    <span class="moth-time">Dec</span>
                                </div>
                            </div>
                            <div class="post-content">
                                <h3><a href="blog-details.html">Etiam eros massa</a></h3>
                                <span class="meta-author"> Demo koparion </span>
                                <p>Discover five of our favourite dresses from our new collection that are destined to
                                    be worn and loved immediately.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- recent-post-area-end -->

    <!-- social-group-area-start -->
    <div class="social-group-area ptb-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="section-title-3">
                        <h3>Latest Tweets</h3>
                    </div>
                    <div class="twitter-content">
                        <div class="twitter-icon">
                            <a href="#"><i class="fa fa-twitter"></i></a>
                        </div>
                        <div class="twitter-text">
                            <p>
                                Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum.
                                Mirum notare quam
                            </p>
                            <a href="#">koparion</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="section-title-3">
                        <h3>Stay Connected</h3>
                    </div>
                    <div class="link-follow">
                        <ul>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                            <li><a href="#"><i class="fa fa-flickr"></i></a></li>
                            <li><a href="#"><i class="fa fa-vimeo"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
