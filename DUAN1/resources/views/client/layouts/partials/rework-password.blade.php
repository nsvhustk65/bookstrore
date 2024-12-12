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
                            <li><a href="#" class="active">tạo mật khẩu mới</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumbs-area-end -->

    <div class="reset-password-area mb-70">
        <div class="container">
            <div class="row">
                <div class="user-login-area mb-70">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-title text-center mb-30">
                                    <h2>Tạo mật khẩu mới</h2>
                                </div>
                            </div>
                            <div class="offset-lg-3 col-lg-6 col-md-12 col-12">
                                <form action="{{ route('loginUser') }}" method="post">
                                    @csrf

                                    <div class="login-form">
                                        <div class="single-login">
                                            <label>Nhập mật khẩu mới<span>*</span></label>
                                            <input type="text" name="" />
                                        </div>
                                        <div class="single-login">
                                            <label>Xác nhận mật khẩu<span>*</span></label>
                                            <input type="text" name="" />
                                        </div>
                                        <div class="single-login single-login-2">
                                            <button type="submit" class="custom-button">Đăng nhập</button>
                                        </div>

                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
