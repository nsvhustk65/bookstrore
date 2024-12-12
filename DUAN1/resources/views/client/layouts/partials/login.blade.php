@extends('client.layouts.master')
@section('content')
    <!-- breadcrumbs-area-start -->
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
    <div class="breadcrumbs-area mb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumbs-menu">
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#" class="active">login</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumbs-area-end -->

    <!-- user-login-area-start -->
    <div class="user-login-area mb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="login-title text-center mb-30">
                        <h2>Đăng Nhập</h2>
                    </div>
                    @if (session('success'))
                        <div>{{ session('success') }}</div>
                    @endif
                </div>
                <div class="offset-lg-3 col-lg-6 col-md-12 col-12">
                    <form style="margin-bottom: 70px" action="{{ route('loginUser') }}" method="post">
                        @csrf
                        <div class="login-form">
                            <div class="single-login">
                                <label>Nhập email<span>*</span></label>
                                <input type="text" name="email" value="{{ old('email') }}" />
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="single-login">
                                <label>Nhập mật khẩu<span>*</span></label>
                                <input type="password" name="password" />
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="single-login single-login-2">
                                <button type="submit" class="custom-button">Đăng nhập</button>
                            </div>
                            <div>
                                <a href="{{ route('khoiphucmatkhau') }}">Bạn quên mật khẩu?</a>
                                <div></div>
                                <a href="{{ route('dangky') }}">Bạn chưa có tài khoản?</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- user-login-area-end -->
@endsection
