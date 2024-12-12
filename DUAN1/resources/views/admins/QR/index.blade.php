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
                    <h4 class="fs-18 fw-semibold m-0">Ảnh Qr Thanh Toán</h4>
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
                        <div class="card-header d-flex justify-content-between">
                            <h5 class="card-title mb-0 align-content-center">list ảnh Qr</h5>
                            <a href="{{route('admins.anh.create')}}" class="btn btn-success">
                                <i data-feather="plus-square"></i> Thêm Mới
                            </a>

                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">ảnh QR</th>
                                            <th>TRạng Thái</th>
                                            <th>xóa</th>
                                            <td>sửa</td>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($listanh as $anh)
                                            <tr>
                                                <td class="row">{{$anh->id}}</td>
                                                <td><img src="{{ Storage::url($anh->qr_code)}}" alt="{{$anh->qr_code}}" style="width: 200px"></td>
                                                <td>{{$anh->status}}</td>
                                                <td>xóa</td>
                                                <td><form action="{{route('admins.anh.edit', $anh->id)}}">
                                                    @csrf
                                                    <button type="submit">Sửa</button>
                                                </form></td>
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
    </div>

@endsection
