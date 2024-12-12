@extends('admins.master')
@section('content')
    <div class="content">
        <!-- Start Content-->
        <div class="container-xxl">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Nhà Xuất bản</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <h5 class="card-title mb-0">Thêm nhà xuất bản</h5>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <form action="{{route('admins.publishers.store')}}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Tên xuất bản</label>
                                            <input type="text" id="name" name="name"
                                                class="form-control">
                                        </div>
                                         <div class="mb-3">
                                            <label for="mo_ta" class="form-label">Địa chỉ</label>
                                            <input type="text" id="mo_ta" name="address"
                                                class="form-control">
                                        </div>  
                                         <div class="mb-3">
                                            <label for="mo_ta" class="form-label">phone</label>
                                            <input type="text" id="mo_ta" name="phone"
                                                class="form-control">
                                        </div>                                        
                                    </div>
                                    <div class="d-flex"><button type="submit" class="btn btn-primary">Thêm mới</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div> <!-- container-fluid -->
    </div>
@endsection
@section('js')

@endsection
