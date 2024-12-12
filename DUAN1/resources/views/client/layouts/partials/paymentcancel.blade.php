

@extends('client.layouts.master')
@section('content')
    <div class="breadcrumbs-area mb-70">
        <div class="container">
            <h1>Thanh toán cho đơn hàng #{{ $order->id }} đã bị hủy</h1>
            <p>Vui lòng thử lại sau!</p>
        </div>
    </div>
@endsection
