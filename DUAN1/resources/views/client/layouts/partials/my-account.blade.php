@extends('client.layouts.master')
@section('content')
    <!-- breadcrumbs-area-start -->
    <div class="breadcrumbs-area mb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumbs-menu">
                        <ul>
                            <li><a href="#">Trang chủ</a></li>
                            <li><a href="#" class="active">tài khoản của tôi</a></li>
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
                        <h2>Tài khoản của tôi</h2>
                    </div>
                </div>
            </div>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
        </div>

    </div>

    <!-- entry-header-area-end -->
    <!-- my account wrapper start -->
    <div class="my-account-wrapper mb-70">
        <div class="container">
            <div class="section-bg-color">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- My Account Page Start -->
                        <div class="myaccount-page-wrapper">
                            <!-- My Account Tab Menu Start -->
                            <div class="row">
                                <div class="col-lg-3 col-md-4">
                                    <div class="myaccount-tab-menu nav" role="tablist">
                                        <a href="#dashboad" class="active" data-bs-toggle="tab"><i
                                                class="fa fa-dashboard"></i>
                                            Tổng quan</a>
                                        <a href="#orders" data-bs-toggle="tab"><i class="fa fa-cart-arrow-down"></i>
                                            Đơn hàng</a>

                                        <a href="#address-edit" data-bs-toggle="tab"><i class="fa fa-map-marker"></i>
                                            Địa chỉ</a>
                                        <a href="#account-info" data-bs-toggle="tab"><i class="fa fa-user"></i> Tài khoản
                                            chi tiết</a>
                                        <a href="{{ route('logout') }}"><i class="fa fa-sign-out"></i> Đăng xuất</a>
                                    </div>
                                </div>
                                <!-- My Account Tab Menu End -->

                                <!-- My Account Tab Content Start -->
                                <div class="col-lg-9 col-md-8">
                                    <div class="tab-content" id="myaccountContent">
                                        <!-- Single Tab Content Start -->
                                        <div class="tab-pane fade show active" id="dashboad" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h5>Tổng quan</h5>
                                                <div class="welcome">
                                                    <p>Xin chào, <strong>{{ Auth::user()->name }}</strong> ( Nếu không
                                                        phải <strong>{{ Auth::user()->name }}
                                                            !</strong>
                                                    <form action="{{ route('logout') }} " method="POST">
                                                        @csrf
                                                        <button class="btn btn-primary">logout</button>
                                                        )</p>
                                                    </form>
                                                </div>
                                                <p class="mb-0">Từ bảng điều khiển tài khoản của bạn. bạn có thể dễ dàng
                                                    kiểm tra &
                                                    xem các đơn đặt hàng gần đây của bạn, quản lý địa chỉ giao hàng và thanh
                                                    toán của bạn
                                                    và chỉnh sửa mật khẩu và chi tiết tài khoản của bạn.</p>
                                            </div>
                                        </div>
                                        <!-- Single Tab Content End -->

                                        <!-- Single Tab Content Start -->
                                        <div class="tab-pane fade" id="orders" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h5>Đơn hàng</h5>
                                                <div class="myaccount-table table-responsive text-center">
                                                    <table class="table table-bordered">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th>Đơn đặt hàng</th>
                                                                <th>Ngày đặt hàng</th>
                                                                <th>Trạng thái</th>
                                                                <th>Tổng tiền</th>
                                                                <th>Hành động</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($orders as $order)
                                                                <tr>
                                                                    <td>{{ $order->ma_don_hang }}</td>
                                                                    <td>{{ $order->created_at }}</td>
                                                                    <td>{{ $order->trang_thai_don_hang }}</td>
                                                                    <td>{{ $order->tien_hang }} VND</td>
                                                                    <td>
                                                                        <form
                                                                            action="{{ route('admins.orders.updateClient', $order->id) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            <button class="btn btn-danger">Hủy</button>
                                                                        </form>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Single Tab Content End -->

                                        <!-- Single Tab Content End -->

                                        <!-- Single Tab Content Start -->

                                        <!-- Single Tab Content End -->

                                        <!-- Single Tab Content Start -->
                                        <div class="tab-pane fade" id="address-edit" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h5>Địa chỉ thanh toán</h5>
                                                <address>
                                                    <p><strong>{{ $user->name }}</strong></p>
                                                    <p>{{ $user->address }}</p>
                                                    <p>Mobile: {{ $user->phone }}</p>
                                                </address>
                                            </div>
                                        </div>
                                        <!-- Single Tab Content End -->

                                        <!-- Single Tab Content Start -->
                                        <div class="tab-pane fade" id="account-info" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h5>Tài khoản chi tiết</h5>
                                                <div class="account-details-form">
                                                    <div class="single-input-item">
                                                        <h6>Họ và Tên: <span>{{ $user->name }}</span></h6>
                                                    </div>
                                                    <div class="single-input-item">
                                                        <h6>Email: <span>{{ $user->email }}</span></h6>
                                                    </div>
                                                    <div class="single-input-item">
                                                        <h6>Số điện thoại : <span>{{ $user->phone }}</span></h6>
                                                    </div>
                                                    <div class="single-input-item">
                                                        <h6>Địa chỉ: <span>{{ $user->address }}</span></h6>
                                                    </div>
                                                    <div class="d-flex">
                                                        <div class="single-input-item">
                                                            <a class="btn btn-sqr" href="{{ route('doimatkhau') }}">Thay
                                                                đổi mật khẩu</a>
                                                        </div>
                                                        <div class="single-input-item">
                                                            <a class="btn btn-sqr" href="{{ route('profile') }}">Thay đổi
                                                                thông tin</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- Single Tab Content End -->
                                    </div>
                                </div> <!-- My Account Tab Content End -->
                            </div>
                        </div> <!-- My Account Page End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- my account wrapper end -->
@endsection
