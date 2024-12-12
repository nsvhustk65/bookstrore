
@extends('client.layouts.master')
@section('content')
    <div class="breadcrumbs-area mb-70">
        <div class="container">
            <h1>Thanh toán cho đơn hàng #{{ $order->id }} đã thành công</h1>
            <p>Cảm ơn bạn đã mua hàng!</p>
        </div>
    </div>
@endsection
