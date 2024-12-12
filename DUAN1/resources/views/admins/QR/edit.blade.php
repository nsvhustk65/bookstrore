@extends('admins.master')
@section('title')
@endsection
@section('content')
    <div class="content">
        <!-- Start Content-->
        <div class="container-xxl">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Danh Mục</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <h5 class="card-title mb-0">Sửa Danh Mục</h5>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <section class="qr-image-section">
                                <h2>Quản lý Trạng thái Ảnh QR</h2>
                                <p>Danh sách ảnh QR và trạng thái hiện tại:</p>

                                <div class="qr-image-list">

                                    <!-- Form sửa trạng thái -->
                                        <form action="{{ route('admins.anh.toggleVisibility',['id' => $qrImage->id]) }}" method="post" class="update-status-form">
                                            @csrf
                                            <label>
                                                <input type="radio" name="status" value="1" {{ $qrImage->status == 1 ? 'checked' : '' }}>
                                                Hiển thị
                                            </label>
                                            <label>
                                                <input type="radio" name="status" value="0" {{ $qrImage->status == 0 ? 'checked' : '' }}>
                                                Ẩn
                                            </label>
                                            <button type="submit" class="update-status-btn">Cập nhật trạng thái</button>
                                        </form>
                                    </div>

                                </div>
                            </section>

                        </div>

                    </div>
                </div>
            </div>

        </div> <!-- container-fluid -->
    </div>
@endsection
@section('js')

@endsection
