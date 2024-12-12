@extends('client.layouts.master')
@section('content')
    <!-- breadcrumbs-area-start -->
    <div class="breadcrumbs-area py-3 bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Login</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Khôi Phục Mật Khẩu</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- breadcrumbs-area-end -->

    <!-- user-login-area-start -->
    <div class="user-login-area my-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8">
                    <div class="card shadow-lg border-0">
                        <div class="card-body p-4">
                            <div class="text-center mb-4">
                                <h2>Đặt Lại Mật Khẩu</h2>
                            </div>
                            <form action="{{ route('passwordupdate') }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="email" class="form-label">Nhập Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
                                    @if ($errors->has('email'))
                                        <div class="alert alert-danger mt-2">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Nhập Mật Khẩu Mới <span class="text-danger">*</span></label>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Mật khẩu mới" required>
                                    @if ($errors->has('password'))
                                        <div class="alert alert-danger mt-2">{{ $errors->first('password') }}</div>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Xác Nhận Mật Khẩu Mới <span class="text-danger">*</span></label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Xác nhận mật khẩu" required>
                                    @if ($errors->has('password_confirmation'))
                                        <div class="alert alert-danger mt-2">{{ $errors->first('password_confirmation') }}</div>
                                    @endif
                                </div>

                                <div class="text-center mt-4">
                                    <button type="submit" class="custom-button  ">Đặt Lại Mật Khẩu</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- user-login-area-end -->
@endsection
