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
                    <h4 class="fs-18 fw-semibold m-0">Nhà xuất bản</h4>
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
                            <h5 class="card-title mb-0 align-content-center">Danh Sách nhà xuất bản</h5>
                            <a href="{{ route('admins.publishers.create') }}" class="btn btn-success">
                                <i data-feather="plus-square"></i> Thêm Mới
                            </a>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Tên</th>
                                            <th scope="col">địa chỉ</th>
                                            <th scope="col">Số điện thoại</th>
                                            <th scope="col">Hành Động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($listPublisher as $index => $item)
                                            <tr>
                                                <th scope="row">{{ $index + 1 }}</th>
                                                <td>{{ $item->name }}</td>
                                                <td>
                                                    {{ $item->address}}
                                                </td>
                                                <td>{{ $item->phone }}</td>
                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <!-- Sửa -->
                                                        <a href="{{ route('admins.publishers.edit', $item->id) }}" class="btn btn-outline-primary btn-sm me-2">
                                                            <i class="mdi mdi-pencil text-muted fs-14"></i>
                                                        </a>
                                                        <!-- Xóa -->
                                                        <form action="{{ route('admins.publishers.destroy', $item->id) }}" method="POST" class="d-inline me-2">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                                                                <i class="mdi mdi-delete text-muted fs-14"></i>
                                                            </button>
                                                        </form>
                                                        <!-- Xem -->
                                                        {{-- <a href="{{ route('admins.categories.categoryByProduct', $item->id) }}" class="btn btn-outline-info btn-sm">
                                                            <i class="mdi mdi-eye text-muted fs-14"></i>
                                                        </a> --}}
                                                    </div>
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
    </div>

@endsection
