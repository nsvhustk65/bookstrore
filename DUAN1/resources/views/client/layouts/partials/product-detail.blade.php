@extends('client.layouts.master')
@section('content')
<style>

</style>
    <!-- breadcrumbs-area-start -->
    <div class="breadcrumbs-area mb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumbs-menu">
                        <ul>
                            <li><a href="{{route('index')}}">Home</a></li>
                            <li><a href="#" class="active">product-details</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumbs-area-end -->
    <!-- product-main-area-start -->
    <div class="product-main-area mb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-12 col-12 order-lg-1 order-1">
                    <!-- product-main-area-start -->
                    <div class="product-main-area">
                        <div class="row">
                            <div class="col-lg-5 col-md-6 col-12">
                                <div class="flexslider">
                                    <ul class="slides">
                                        <li data-thumb="{{ Storage::url($product->image) }}">
                                            <img src="{{ Storage::url($product->image) }}" alt="woman" />
                                        </li>
                                        @foreach ($product->imageProduct as $item)
                                            <li data-thumb="{{Storage::url($item->image)}}">
                                                <img src="{{Storage::url($item->image)}}" alt="woman" />
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-6 col-12">
                                <div class="product-info-main">
                                    <div class="page-title">
                                        <h1>{{$product->ten_san_pham}}</h1>
                                    </div>
                                    <div class="product-info-stock-sku">
                                        <span>In stock</span>
                                        <div class="product-attribute">
                                            <span>SKU</span>
                                            <span class="value">{{$product->ma_san_pham}}</span>
                                        </div>
                                    </div>
                                    <div class="product-reviews-summary">
                                        <div class="rating-summary">
                                            <a href="#"><i class="fa fa-star"></i></a>
                                            <a href="#"><i class="fa fa-star"></i></a>
                                            <a href="#"><i class="fa fa-star"></i></a>
                                            <a href="#"><i class="fa fa-star"></i></a>
                                            <a href="#"><i class="fa fa-star"></i></a>
                                        </div>
                                        <div class="reviews-actions">
                                            <a href="#">3 Reviews</a>
                                            <a href="#" class="view">Add Your Review</a>
                                        </div>
                                    </div>
                                    <div class="product-info-price">
                                        <div class="price-final">
                                            <span>{{number_format($product->gia_khuyen_mai, 0, ',', '.')}} đ</span>
                                            <span class="old-price">{{number_format($product->gia_san_pham, 0, ',', '.')}} đ</span>
                                        </div>
                                    </div>
                                    <div class="product-add-form">
                                        <form action="{{route('addCart')}}" method="POST">
                                            @csrf
                                            <div class="quality-button">
                                                <button type="button" class="btn-quantity decrease">-</button>
                                                <input type="text" id="quantity" name="quantity" value="1" readonly>
                                                <button type="button" class="btn-quantity increase">+</button>
                                            </div>
                                                <input type="hidden" name="id" value="{{ $product->id }}">
                                                <input type="hidden" name="ten_san_pham" value="{{ $product->ten_san_pham }}">
                                                <input type="hidden" name="price" value="{{ $product->gia_khuyen_mai }}">
                                                <input type="hidden" name="image" value="{{ $product->image }}">
                                            <button type="submit">Add to cart</button>
                                        </form>
                                    </div>
                                    <div class="product-social-links">
                                        <div class="product-addto-links">
                                            <a href="#"><i class="fa fa-heart"></i></a>
                                            <a href="#"><i class="fa fa-pie-chart"></i></a>
                                            <a href="#"><i class="fa fa-envelope-o"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- product-main-area-end -->
                    <!-- product-info-area-start -->
                    <div class="product-info-area mt-80">
                        <!-- Nav tabs -->
                        <ul class="nav">
                            <li><a class="active" href="#Details" data-bs-toggle="tab">Details</a></li>
                            <li><a href="#Reviews" data-bs-toggle="tab">Reviews 3</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="Details">
                                <div class="valu">
									<h5>Mô tả sản phẩm</h5>
                                    <p>{{$product->mo_ta}}</p>
									<h5>Tác giả</h5>
									<p>Tên tác giả:{{$product->author->name}} <br>
										{{$product->author->bio}}
									</p>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="Reviews">
                                <div class="valu valu-2">
                                    <div class="section-title mb-60 mt-60">
                                        <h2>Customer Reviews</h2>
                                    </div>
                                    <ul>
                                        <li>
                                            <div class="review-title">
                                                <h3>themes</h3>
                                            </div>
                                            <div class="review-left">
                                                <div class="review-rating">
                                                    <span>Price</span>
                                                    <div class="rating-result">
                                                        <a href="#"><i class="fa fa-star"></i></a>
                                                        <a href="#"><i class="fa fa-star"></i></a>
                                                        <a href="#"><i class="fa fa-star"></i></a>
                                                        <a href="#"><i class="fa fa-star"></i></a>
                                                        <a href="#"><i class="fa fa-star"></i></a>
                                                    </div>
                                                </div>
                                                <div class="review-rating">
                                                    <span>Value</span>
                                                    <div class="rating-result">
                                                        <a href="#"><i class="fa fa-star"></i></a>
                                                        <a href="#"><i class="fa fa-star"></i></a>
                                                        <a href="#"><i class="fa fa-star"></i></a>
                                                        <a href="#"><i class="fa fa-star"></i></a>
                                                        <a href="#"><i class="fa fa-star"></i></a>
                                                    </div>
                                                </div>
                                                <div class="review-rating">
                                                    <span>Quality</span>
                                                    <div class="rating-result">
                                                        <a href="#"><i class="fa fa-star"></i></a>
                                                        <a href="#"><i class="fa fa-star"></i></a>
                                                        <a href="#"><i class="fa fa-star"></i></a>
                                                        <a href="#"><i class="fa fa-star"></i></a>
                                                        <a href="#"><i class="fa fa-star"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="review-right">
                                                <div class="review-content">
                                                    <h4>themes </h4>
                                                </div>
                                                <div class="review-details">
                                                    <p class="review-author">Review by<a href="#">plaza</a></p>
                                                    <p class="review-date">Posted on <span>12/9/16</span></p>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="review-add">
                                        <h3>You're reviewing:</h3>
                                        <h4>Joust Duffle Bag</h4>
                                    </div>
                                    <div class="review-field-ratings">
                                        <span>Your Rating <sup>*</sup></span>
                                        <div class="control">
                                            <div class="single-control">
                                                <span>Value</span>
                                                <div class="review-control-vote">
                                                    <a href="#"><i class="fa fa-star"></i></a>
                                                    <a href="#"><i class="fa fa-star"></i></a>
                                                    <a href="#"><i class="fa fa-star"></i></a>
                                                    <a href="#"><i class="fa fa-star"></i></a>
                                                    <a href="#"><i class="fa fa-star"></i></a>
                                                </div>
                                            </div>
                                            <div class="single-control">
                                                <span>Quality</span>
                                                <div class="review-control-vote">
                                                    <a href="#"><i class="fa fa-star"></i></a>
                                                    <a href="#"><i class="fa fa-star"></i></a>
                                                    <a href="#"><i class="fa fa-star"></i></a>
                                                    <a href="#"><i class="fa fa-star"></i></a>
                                                    <a href="#"><i class="fa fa-star"></i></a>
                                                </div>
                                            </div>
                                            <div class="single-control">
                                                <span>Price</span>
                                                <div class="review-control-vote">
                                                    <a href="#"><i class="fa fa-star"></i></a>
                                                    <a href="#"><i class="fa fa-star"></i></a>
                                                    <a href="#"><i class="fa fa-star"></i></a>
                                                    <a href="#"><i class="fa fa-star"></i></a>
                                                    <a href="#"><i class="fa fa-star"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="review-form">
                                        <div class="single-form">
                                            <label>Nickname <sup>*</sup></label>
                                            <form action="#">
                                                <input type="text" />
                                            </form>
                                        </div>
                                        <div class="single-form single-form-2">
                                            <label>Summary <sup>*</sup></label>
                                            <form action="#">
                                                <input type="text" />
                                            </form>
                                        </div>
                                        <div class="single-form">
                                            <label>Review <sup>*</sup></label>
                                            <form action="#">
                                                <textarea name="massage" cols="10" rows="4"></textarea>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="review-form-button">
                                        <a href="#">Submit Review</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- product-info-area-end -->
                    <!-- new-book-area-start -->
                    {{-- <div class="new-book-area mt-60">
                        <div class="section-title text-center mb-30">
                            <h3>upsell products</h3>
                        </div>
                        <div class="tab-active-2 owl-carousel">
                            <!-- single-product-start -->
                            <div class="product-wrapper">
                                <div class="product-img">
                                    <a href="#">
                                        <img src="img/product/1.jpg" alt="book" class="primary" />
                                    </a>
                                    <div class="quick-view">
                                        <a class="action-view" href="#" data-bs-target="#productModal"
                                            data-bs-toggle="modal" title="Quick View">
                                            <i class="fa fa-search-plus"></i>
                                        </a>
                                    </div>
                                    <div class="product-flag">
                                        <ul>
                                            <li><span class="sale">new</span></li>
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
                                    <h4><a href="#">Joust Duffle Bag</a></h4>
                                    <div class="product-price">
                                        <ul>
                                            <li>$60.00</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-link">
                                    <div class="product-button">
                                        <a href="#" title="Add to cart"><i class="fa fa-shopping-cart"></i>Add to
                                            cart</a>
                                    </div>
                                    <div class="add-to-link">
                                        <ul>
                                            <li><a href="product-details.html" title="Details"><i
                                                        class="fa fa-external-link"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- single-product-end -->
                            <!-- single-product-start -->
                            <div class="product-wrapper">
                                <div class="product-img">
                                    <a href="#">
                                        <img src="img/product/3.jpg" alt="book" class="primary" />
                                    </a>
                                    <div class="quick-view">
                                        <a class="action-view" href="#" data-bs-target="#productModal"
                                            data-bs-toggle="modal" title="Quick View">
                                            <i class="fa fa-search-plus"></i>
                                        </a>
                                    </div>
                                    <div class="product-flag">
                                        <ul>
                                            <li><span class="sale">new</span></li>
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
                                    <h4><a href="#">Chaz Kangeroo Hoodie</a></h4>
                                    <div class="product-price">
                                        <ul>
                                            <li>$52.00</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-link">
                                    <div class="product-button">
                                        <a href="#" title="Add to cart"><i class="fa fa-shopping-cart"></i>Add to
                                            cart</a>
                                    </div>
                                    <div class="add-to-link">
                                        <ul>
                                            <li><a href="product-details.html" title="Details"><i
                                                        class="fa fa-external-link"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- single-product-end -->
                            <!-- single-product-start -->
                            <div class="product-wrapper">
                                <div class="product-img">
                                    <a href="#">
                                        <img src="img/product/5.jpg" alt="book" class="primary" />
                                    </a>
                                    <div class="quick-view">
                                        <a class="action-view" href="#" data-bs-target="#productModal"
                                            data-bs-toggle="modal" title="Quick View">
                                            <i class="fa fa-search-plus"></i>
                                        </a>
                                    </div>
                                    <div class="product-flag">
                                        <ul>
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
                                    <h4><a href="#">Set of Sprite Yoga Straps</a></h4>
                                    <div class="product-price">
                                        <ul>
                                            <li> <span>Starting at</span>$34.00</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-link">
                                    <div class="product-button">
                                        <a href="#" title="Add to cart"><i class="fa fa-shopping-cart"></i>Add to
                                            cart</a>
                                    </div>
                                    <div class="add-to-link">
                                        <ul>
                                            <li><a href="product-details.html" title="Details"><i
                                                        class="fa fa-external-link"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- single-product-end -->
                            <!-- single-product-start -->
                            <div class="product-wrapper">
                                <div class="product-img">
                                    <a href="#">
                                        <img src="img/product/7.jpg" alt="book" class="primary" />
                                    </a>
                                    <div class="quick-view">
                                        <a class="action-view" href="#" data-bs-target="#productModal"
                                            data-bs-toggle="modal" title="Quick View">
                                            <i class="fa fa-search-plus"></i>
                                        </a>
                                    </div>
                                    <div class="product-flag">
                                        <ul>
                                            <li><span class="sale">new</span></li>
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
                                    <h4><a href="#">Strive Shoulder Pack</a></h4>
                                    <div class="product-price">
                                        <ul>
                                            <li>$30.00</li>
                                            <li class="old-price">$32.00</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-link">
                                    <div class="product-button">
                                        <a href="#" title="Add to cart"><i class="fa fa-shopping-cart"></i>Add to
                                            cart</a>
                                    </div>
                                    <div class="add-to-link">
                                        <ul>
                                            <li><a href="product-details.html" title="Details"><i
                                                        class="fa fa-external-link"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- single-product-end -->
                        </div>
                    </div> --}}
                    <!-- new-book-area-start -->
                </div>
                <div class="col-lg-3 col-md-12 col-12 order-lg-2 order-2">
                    <div class="shop-left">
                        <div class="left-title mb-20">
                            <h4>Related Products</h4>
                        </div>
                        <div class="random-area mb-30">
                            <div class="product-active-2 owl-carousel">
                                <div class="product-total-2">
									@foreach($products11 as $item)
										<div class="single-most-product bd mb-18">
											<div class="most-product-img">
												<a href="{{route('detailProduct',$item->id)}}"><img src="{{Storage::url($item->image)}}" alt="book" /></a>
											</div>
											<div class="most-product-content">
												<div class="product-rating">
													<ul>
														<li><a href="#"><i class="fa fa-star"></i></a></li>
														<li><a href="#"><i class="fa fa-star"></i></a></li>
														<li><a href="#"><i class="fa fa-star"></i></a></li>
														<li><a href="#"><i class="fa fa-star"></i></a></li>
														<li><a href="#"><i class="fa fa-star"></i></a></li>
													</ul>
												</div>
												<h4><a href="{{route('detailProduct',$item->id)}}">{{$item->ten_san_pham}}</a></h4>
												<div class="product-price">
													<ul>
														<li>{{number_format($item->gia_khuyen_mai, 0, ',', '.')}} đ</li>
                                                        <li class="old-price">{{number_format($item->gia_san_pham, 0, ',', '.')}} đ</li>
													</ul>
												</div>
											</div>
										</div>
									@endforeach
                                </div>
                                <div class="product-total-2">
									@foreach ($productSoLuong as $item1)
										<div class="single-most-product bd mb-18">
                                        <div class="most-product-img">
                                            <a href="{{route('detailProduct',$item1->id)}}"><img src="{{Storage::url($item1->image)}}" alt="book" /></a>
                                        </div>
                                        <div class="most-product-content">
                                            <div class="product-rating">
                                                <ul>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                </ul>
                                            </div>
                                            <h4><a href="{{route('detailProduct',$item1->id)}}">{{$item1->ten_san_pham}}</a></h4>
                                            <div class="product-price">
                                                <ul>
                                                <li>{{number_format($item1->gia_khuyen_mai, 0, ',', '.')}} đ</li>
                                                <li class="old-price">{{number_format($item1->gia_san_pham, 0, ',', '.')}} đ</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
									@endforeach

                                </div>
                            </div>
                        </div>
                        <div class="banner-area mb-30">
                            <div class="banner-img-2">
                                <a href="#"><img src="/client/img/banner/33.jpg" alt="banner" /></a>
                            </div>
                        </div>
                        <div class="left-title-2 mb-30">
                            <h2>Compare Products</h2>
                            <p>You have no items to compare.</p>
                        </div>
                        <div class="left-title-2">
                            <h2>My Wish List</h2>
                            <p>You have no items in your wish list.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- product-main-area-end -->
@endsection
@section('js')
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const decreaseBtn = document.querySelector('.decrease');
        const increaseBtn = document.querySelector('.increase');
        const quantityInput = document.getElementById('quantity');

        // Nút giảm số lượng
        decreaseBtn.addEventListener('click', function () {
            let currentValue = parseInt(quantityInput.value) || 1;
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
            }
        });

        // Nút tăng số lượng
        increaseBtn.addEventListener('click', function () {
            let currentValue = parseInt(quantityInput.value) || 1;
            quantityInput.value = currentValue + 1;
        });
    });
</script>
@endsection
