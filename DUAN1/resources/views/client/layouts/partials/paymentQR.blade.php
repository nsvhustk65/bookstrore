@extends('client.layouts.master')

@section('content')
    <!-- Breadcrumb -->
    <div class="breadcrumbs-area py-3 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{route('index')}}" class="text-primary">Trang chủ </a></li>
                            <li class="item" aria-current="page">| Thanh Toán</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Section -->
    <div class="user-login-area py-5"
        style="background-image: url('/images/vpbank-pattern.png'); background-size: cover; background-repeat: no-repeat;">
        <div class="container">
            <div class="row g-4">
                <!-- User Info (Left Side) -->
                <div class="col-md-4">
                    <div class="card shadow-lg border-0" style="background-color: rgba(255, 255, 255, 0.9);">
                        <div class="card-header bg-primary text-white text-center">
                            <h5 class="mb-0 fw-bold" style="font-size: 1.5rem;">Thông Tin Người Mua</h5>
                        </div>
                        <div class="card-body">
                            <p style="font-size: 1.2rem;"><strong>Họ tên:</strong> {{ Auth::user()->name }}</p>
                            <p style="font-size: 1.2rem;"><strong>Số điện thoại:</strong> {{ Auth::user()->phone }}</p>
                            <p style="font-size: 1.2rem;"><strong>Địa chỉ:</strong> {{ Auth::user()->address }}</p>
                            <p style="font-size: 1.2rem;"><strong>Email:</strong> {{ Auth::user()->email }}</p>
                            <!-- Danh sách sản phẩm -->
                            <div class="card mt-3">
                                <div class="card-header bg-info text-white">
                                    <h5 class="mb-0">Chi Tiết Sản Phẩm</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group">
                                        <!-- Hiển thị mã đơn hàng chỉ một lần -->
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span><strong>Mã Đơn Hàng:</strong> {{ $order->ma_don_hang }}</span>
                                           <li class="list-group-item d-flex justify-content-between align-items-center">Quý Khách Vui Lòng Nhập Mã Đơn Hàng Trong Nội Dung Chuyển Khoản.</li>
                                        </li>

                                        <!-- Hiển thị danh sách sản phẩm -->
                                        @foreach ($order->OrderDetail as $detail)
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <span><strong>Tên Sản Phẩm:</strong> {{ $detail->product->ten_san_pham }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <span><strong>Số Lượng:</strong> {{ $detail->so_luong }}</span>
                                            </li>
                                        @endforeach

                                        <!-- Hiển thị tổng tiền cho tất cả sản phẩm (lấy từ bảng order) -->
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span><strong>Tiền Tổng Đơn Hàng:</strong> {{ number_format($order->tong_tien , 0, ',', '.') }} VND</span>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <small class="text-muted">Thông tin sẽ được bảo mật tuyệt đối.</small>
                        </div>
                    </div>
                </div>

                <!-- QR Code & Button (Right Side) -->
                <div class="col-md-8">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-success text-white text-center">
                            <h5 class="mb-0 fw-bold" style="font-size: 1.5rem;">Mã QR Thanh Toán VPBank</h5>
                        </div>
                        <div class="card-body text-center">
                            @if ($visibleQrImages->isNotEmpty())
                                @foreach ($visibleQrImages as $qr)
                                    <div class="mb-4">
                                        <img src="{{ Storage::url($qr->qr_code) }}" alt="QR Code"
                                            class="img-fluid rounded shadow"
                                            style="width: 350px; height: auto; border: 5px solid #007bff; border-radius: 20px;">
                                    </div>
                                @endforeach
                                <p class="mt-3" style="font-size: 1.2rem;">
                                    <strong>Chủ tài khoản:</strong> Trần Minh Đức <br>
                                    <strong>Số tài khoản:</strong> 3493000002
                                </p>
                            @else
                                <p class="text-danger" style="font-size: 1.2rem;">Không có mã QR nào tồn tại.</p>
                            @endif
                        </div>
                        <div class="card-footer text-center d-flex justify-content-center gap-3">
                            <button type="button" class="btn btn-danger btn-lg w-25" data-bs-toggle="modal"
                                data-bs-target="#cancelPaymentModal">
                                Hủy
                            </button>
                            <button type="button" class="btn btn-primary btn-lg w-50" data-bs-toggle="modal"
                                data-bs-target="#confirmPaymentModal">
                                Xác Nhận Thanh Toán
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Payment Confirmation -->
    <div class="modal fade" id="confirmPaymentModal" tabindex="-1" aria-labelledby="confirmPaymentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold text-success" id="confirmPaymentModalLabel">Xác Nhận Thanh Toán</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Cảm Ơn Bạn Đã Mua Hàng !
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <form method="POST" action="{{route('orderconfirm',['orderId' => $order->id])}}">
                        @csrf
                        <input type="hidden" name="ma_don_hang" value="{{ $detail->Order->ma_don_hang }}">
                        <button type="submit" class="btn btn-success">Xác Nhận</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Payment Cancellation -->
    <div class="modal fade" id="cancelPaymentModal" tabindex="-1" aria-labelledby="cancelPaymentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold text-danger" id="cancelPaymentModalLabel">Hủy Thanh Toán</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắn muốn hủy thanh toán không?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <form method="POST" action="{{route('ordercancel',['orderId' => $order->id])}}">
                        @csrf
                        <button type="submit" class="btn btn-danger">Hủy Thanh Toán</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

