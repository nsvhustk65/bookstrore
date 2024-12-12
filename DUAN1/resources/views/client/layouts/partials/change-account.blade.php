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
                            <li><a href="#" class="active">thay đổi mật khẩu </a></li>
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
                                        <a href="#dashboad" data-bs-toggle="tab"><i class="fa fa-dashboard"></i>
                                            Tổng quan</a>
                                        <a href="#orders" data-bs-toggle="tab"><i class="fa fa-cart-arrow-down"></i>
                                            Đơn hàng</a>
                                        <a href="#payment-method" data-bs-toggle="tab"><i class="fa fa-credit-card"></i>
                                            Phương thức thanh toán</a>
                                        <a href="#address-edit" data-bs-toggle="tab"><i class="fa fa-map-marker"></i>
                                            Địa chỉ</a>
                                        <a href="#account-info" class="active" data-bs-toggle="tab"><i
                                                class="fa fa-user"></i> Tài khoản chi tiết</a>
                                        <a href=""><i class="fa fa-sign-out"></i> Đăng xuất</a>
                                    </div>
                                </div>
                                <!-- My Account Tab Menu End -->
                                <!-- My Account Tab Content Start -->
                                <div class="col-lg-9 col-md-8">
                                    <div class="tab-content" id="myaccountContent">
                                        <!-- Single Tab Content Start -->

                                        <!-- Single Tab Content End -->

                                        <!-- Single Tab Content Start -->
                                        <div class="tab-pane fade show active" id="dashboad" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h5>Tài khoản chi tiết</h5>
                                                @if (session('success'))
                                                    <div class="alert alert-success">
                                                        {{ session('success') }}
                                                    </div>
                                                @endif
                                                <div class="account-details-form">
                                                    <form action="{{ route('update-pass', $user) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <fieldset>
                                                            <legend>Thay đổi mật khẩu</legend>
                                                            <div class="single-input-item">
                                                                <label for="currentpwd" class="required">Mật khẩu cũ
                                                                </label>
                                                                <input type="password" name="currentpwd" id="currentpwd"
                                                                    placeholder="Mật khẩu cũ " />
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="single-input-item">
                                                                        <label for="newpwd" class="required">Mật khẩu
                                                                            mới
                                                                        </label>
                                                                        <input type="password" name="newpwd" id="newpwd"
                                                                            placeholder="Mật khẩu mới " />
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="single-input-item">
                                                                        <label for="newpwd_confirmation" class="required">Xác
                                                                            nhận mật khẩu
                                                                        </label>
                                                                        <input type="password" name="newpwd_confirmation" id="newpwd_confirmation"
                                                                            placeholder="Xác nhận mật khẩu " />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                        <div class="single-input-item">
                                                            <button type="submit" class="btn btn-sqr">Lưu thay đổi</button>
                                                        </div>
                                                    </form>
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
