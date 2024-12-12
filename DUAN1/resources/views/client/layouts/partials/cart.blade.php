@extends('client.layouts.master')
@section('content')
@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
    </div>
@endif

    <!-- breadcrumbs-area-start -->
    <div class="breadcrumbs-area mb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumbs-menu">
                        <ul>
                            <li><a href="{{route('index')}}">Home</a></li>
                            <li><a href="{{route('listCart')}}" class="active">cart</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumbs-area-end -->
    <!-- entry-header-area-start -->
    <div class="entry-header-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="entry-header-title">
                        <h2>GIỎ HÀNG</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- entry-header-area-end -->
    <!-- cart-main-area-start -->
    <div class="cart-main-area mb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-content table-responsive mb-15 border-1">
                        <table>
                            <thead>
                                <tr>

                                    <th class="product-thumbnail">Image</th>
                                    <th class="product-name">Product</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-subtotal">Total</th>
                                    <th class="product-remove">Remove</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cart as $key => $item)
                                    <tr>
                                        <td class="product-thumbnail"><a href="#"><img
                                                    src="{{ Storage::url($item['image']) }}" alt="man" /></a></td>
                                        <td class="product-name"><a href="#">{{ $item['ten_san_pham'] }}</a></td>
                                        <td class="product-price"><span
                                                class="amount">{{ number_format($item['price'], 0, ',', '.') }} đ</span>
                                        </td>
                                        <td class="product-quantity">
                                            <input type="number" name="quantity[{{ $key }}]" class="quantity"
                                                value="{{ $item['quantity'] }}" min="1"
                                                data-price="{{ $item['price'] }}" data-key="{{ $key }}">
                                        </td>
                                        <td class="product-subtotal" id="subtotal-{{ $key }}">
                                            {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }} đ</td>
                                        <td class="product-remove">
                                            <form action="{{ route('cart.remove', $key) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE') <!-- Chỉ định phương thức DELETE -->
                                                <button type="submit" class="product-remove"><i
                                                        class="fa fa-times"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-6 col-12">
                    {{-- <div class="buttons-cart mb-30">
                        <ul>
                            <li><a href="#">Update Cart</a></li>
                            <li><a href="#">Continue Shopping</a></li>
                        </ul>
                    </div> --}}
                    {{-- <div class="coupon">
                        <h3>Coupon</h3>
                        <p>Enter your coupon code if you have one.</p>
                        <form action="#">
                            <input type="text" placeholder="Coupon code">
                            <a href="#">Apply Coupon</a>
                        </form>                    </div> --}}
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="cart_totals">
                        <div class="wc-proceed-to-checkout">

                            <a href="{{ route('checkout') }}">Mua hàng</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- cart-main-area-end -->
@endsection
@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.quantity').on('input', function() {
                let quantity = $(this).val(); // Số lượng mới
                if (quantity < 1) {
                    // Nếu người dùng nhập giá trị nhỏ hơn 1, reset lại thành 1
                    $(this).val(1);
                    quantity = 1;
                }
                let price = $(this).data('price'); // Giá sản phẩm
                let key = $(this).data('key'); // Key của sản phẩm trong cart

                // Tính lại tổng giá cho sản phẩm này
                let subtotal = quantity * price;

                // Định dạng số tiền
                let formattedSubtotal = new Intl.NumberFormat('vi-VN', {
                    style: 'currency',
                    currency: 'VND'
                }).format(subtotal);

                // Cập nhật giá trị tổng giá trên giao diện
                $('#subtotal-' + key).text(formattedSubtotal);
            });
        });
    </script>
    <script>
        $('.quantity').on('change', function() {
            let quantity = $(this).val();
            let key = $(this).data('key');

            $.ajax({
                url: '{{ route('updateCart') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    key: key,
                    quantity: quantity
                },
                // success: function(response) {
                //     alert('Cập nhật giỏ hàng thành công!');
                // },
                // error: function() {
                //     alert('Có lỗi xảy ra!');
                // }
            });
        });
    </script>
@endsection
