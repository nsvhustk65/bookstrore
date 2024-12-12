@extends('admins.master')
@section('content')

    <style>
        /* Căn giữa nội dung các ô trong bảng */
        .table td, .table th {
            vertical-align: middle;
            text-align: center;
        }

        /* Đặt khoảng cách giữa các nút trong cột hành động */
        .table .d-flex .btn {
            margin: 0 5px;
        }
    </style>
     <div class="card-body">
        <form action="{{route('admins.orders.update', $orders->id)}}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="orderCode" class="form-label">Mã Đơn Hàng</label>
                <input type="text" class="form-control" id="orderCode" value="{{ $orders->ma_don_hang }}" disabled>
            </div>

            <div class="mb-3">
                <label for="orderStatus" class="form-label">Trạng Thái Đơn Hàng</label>
                <select class="form-select" id="orderStatus" name="trang_thai_don_hang">
                    <option value="Chờ xử lý" {{ $orders->trang_thai_don_hang == 'Chờ xử lý' ? 'selected' : '' }}>Chờ xử lý</option>
                    <option value="Đang Đóng Hàng" {{ $orders->trang_thai_don_hang == 'Đang Đóng Hàng' ? 'selected' : '' }}>Đang Đóng Hàng</option>
                    <option value="Đang vận chuyển" {{ $orders->trang_thai_don_hang == 'Đang vận chuyển' ? 'selected' : '' }}>Đang vận chuyển</option>
                    <option value="Đã giao hàng" {{ $orders->trang_thai_don_hang == 'Đã giao hàng' ? 'selected' : '' }}>Đã giao hàng</option>
                    <option value="Hoàn thành" {{ $orders->trang_thai_don_hang == 'Hoàn thành' ? 'selected' : '' }}>Hoàn thành</option>
                    <option value="Đã hủy" {{ $orders->trang_thai_don_hang == 'Đã hủy' ? 'selected' : '' }}>Đã hủy</option>
                </select>
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('error') }}
            </div>
        @endif
            </div>

            <div class="mb-3">
                <label for="notes" class="form-label">Ghi Chú</label>
                <textarea class="form-control" id="notes" name="ghi_chu" rows="3">{{ $orders->ghi_chu }}</textarea>
            </div>

            <div class="mb-3 d-flex justify-content-center">
                <button type="submit" class="btn btn-primary me-3">Cập Nhật</button>
                <a class="btn btn-secondary" href="{{route('admins.orders.index')}}">Quay Lại</a>
            </div>





        </form>


</div>



@endsection
