@extends('client.layouts.master')
@section('content')
<form action="{{route('dathang')}}" method="post">
    @csrf
    <div class="row">
        <div class="col-lg-6 col-md-12 col-12">
            <div class="checkbox-form">
                <h3>Chi tiết thanh toán</h3>
                <div class="row">
                    <!-- Hiển thị thông tin người dùng -->
                    <div class="col-lg-12 col-md-12 col-12">
                        <div class="checkout-form-list">
                            <label>Họ và Tên <span class="required">*</span></label>
                            <input type="text" name="name" value="{{ Auth::user()->name }}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-12">
                        <div class="checkout-form-list">
                            <label>Số điện thoại <span class="required">*</span></label>
                            <input type="text" name="phone" value="{{ Auth::user()->phone }}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-12">
                        <div class="checkout-form-list">
                            <label>Địa chỉ <span class="required">*</span></label>
                            <input type="text" name="address" value="{{ Auth::user()->address }}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-12">
                        <div class="checkout-form-list">
                            <label>Email <span class="required">*</span></label>
                            <input type="email" name="email" value="{{ Auth::user()->email }}" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12 col-12">
            <div class="your-order">
                <h3>Đơn hàng của bạn</h3>
                <div class="your-order-table table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th class="product-name">Sản phẩm</th>
                                <th class="product-total">Giá Sản phẩm</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart as $item)
                                <tr class="cart_item">
                                    <td class="product-name">
                                        {{ $item['ten_san_pham'] }} <strong class="product-quantity"> ×
                                            {{ $item['quantity'] }}</strong>
                                    </td>
                                    <td class="product-total">
                                        <span class="amount">{{ number_format($item['price'], 0, ',', '.') }} đ</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="cart-subtotal">
                                <th>Tổng cộng giỏ hàng</th>
                                <td><span class="amount">{{ number_format($subtotal, 0, ',', '.') }} đ</span></td>
                            </tr>
                            <tr class="shipping">
                                <th>Phí ship</th>
                                <td><span class="amount">{{ number_format($shipping, 0, ',', '.') }} đ</span></td>
                            </tr>
                            <tr class="order-total">
                                <th>Tổng đơn hàng</th>
                                <td><strong><span class="amount" name="tong_tien">{{ number_format($total, 0, ',', '.') }} đ</span></strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="payment-method">
                    <div class="payment-accordion">
                        <div class="collapses-group">
                            <label>
                                <input type="radio" name="payment_method" value="COD" checked>
                                Thanh toán khi nhận hàng
                            </label>
                            <br>


                              <label>
                                    <input type="radio" name="payment_method" value="Online">
                                    Thanh toán trực tuyến bằng stripe payment
                                </label>

                        </div>
                    </div>
                    <div class="order-button-payment">
                        <button type="submit" class="btn btn-primary">Đặt hàng</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</form>
{{-- <form action="{{url('/payment/create')}}" method="post">
    @csrf
    <button type="submit" class="btn btn-danger">Thanh Toán chức năng </button>
</form> --}}

    <!-- checkout-area-end -->
@endsection
