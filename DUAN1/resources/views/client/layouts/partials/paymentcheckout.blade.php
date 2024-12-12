<!-- resources/views/payment/checkout.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán Stripe</title>
</head>
<body>
    <h1>Thanh toán Đơn hàng #{{ $orderId }}</h1>
    <p><strong>Tổng số tiền:</strong> {{ number_format($order->tong_tien, 2) }} USD</p>

    <!-- Hiển thị mã QR cho người dùng quét -->
    <img src="data:image/png;base64,{{ $qrCodeBase64 }}" alt="QR Code Thanh toán" />

    <!-- Liên kết thanh toán -->
    <a href="{{ $sessionUrl }}">Tiến hành thanh toán</a>
</body>
</html>
