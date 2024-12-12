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

    <div class="content">
        <div class="container-xxl">
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Đơn hàng</h4>
                </div>
            </div>
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
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">


                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th>Mã đơn hàng</th>
                                            <th>Tên người nhận</th>
                                            <th>Địa chỉ nhận</th>
                                            <th>Sản phẩm</th>
                                            <th>Tổng tiền</th>
                                            <th>Trạng thái đơn hàng</th>
                                            <th>Hình Thức Thanh Toán</th>
                                            <th>Trạng Thái Thanh Toán</th>
                                            <th>Ghi Chú</th>
                                            <th>Thời Gian Tạo Đơn Hàng</th>
                                            {{-- <th>Xóa</th> --}}
                                            <th>Cập NHật</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order->ma_don_hang }}</td>
                                            <td>{{ $order->ten_nguoi_nhan }}</td>
                                            <td>{{ $order->address_nguoi_nhan }}</td>
                                            <td>
                                                @if ($order->OrderDetail->isNotEmpty())
                                                <ul class="list-unstyled">
                                                    @foreach ($order->OrderDetail as $item)
                                                        <li>{{ $item->product->ten_san_pham }} (x{{ $item->so_luong }})</li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                <p>Không có sản phẩm trong đơn hàng.</p>
                                            @endif
                                            </td>
                                            <td>{{ number_format($order->tong_tien, 0, ',', '.') }} đ</td>
                                            <td>{{ $order->trang_thai_don_hang }}</td>
                                            <td>{{$order->trang_thai_thanh_toan}}</td>
                                            <td>{{$order->payment_status}}</td>
                                            <td>{{$order->ghi_chu}}</td>
                                            <td>{{$order->created_at}}</td>
                                            {{-- <td>
                                                <form action="{{route('admins.orders.destroy',$order->id)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm">Xóa</button>
                                                </form>
                                            </td> --}}
                                            <td>
                                                <form action="{{route('admins.orders.edit',$order->id)}}">
                                                    <button type="submit" class="btn btn-outline-info btn-sm">cập  nhật</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pagination-wrapper">
            {{ $orders->links('pagination::bootstrap-5') }}
        </div>
    </div>


@endsection
