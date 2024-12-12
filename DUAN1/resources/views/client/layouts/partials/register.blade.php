@extends('client.layouts.master')
@section('content')
    <div class="breadcrumbs-area mb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumbs-menu">
                        <ul>
                            <li><a href="#">Trang chủ</a></li>
                            <li><a href="#" class="active">đăng ký</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="user-login-area mb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="login-title text-center mb-30">
                        <h2>Đăng ký</h2>
                    </div>
                </div>
                <form action="{{ route('dangkyUser') }}" method="post">
                    @csrf

                    <div class="offset-lg-2 col-lg-8 col-md-12 col-12">
                        <div class="billing-fields">
                            <div class="single-register">
                                <label>Họ và Tên<span>*</span></label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Nhập họ và tên" />
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="single-register">
                                <label>Email<span>*</span></label>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Nhập email" />
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="single-register">
                                <label>Số Điện Thoại<span>*</span></label>
                                <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="Nhập số điện thoại" />
                                @error('phone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="single-register">
                                <label>Địa Chỉ<span>*</span></label>
                                <input type="text" name="address" class="form-control" value="{{ old('address') }}" placeholder="Nhập địa chỉ" />
                                @error('address')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="single-register">
                                <label>Mật khẩu<span>*</span></label>
                                <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu" />
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="single-register">
                                <label>Xác nhận mật khẩu<span>*</span></label>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Xác nhận mật khẩu" />
                                @error('password_confirmation')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="single-login single-login-2">
                                <button type="submit" class="custom-button">Đăng ký</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
