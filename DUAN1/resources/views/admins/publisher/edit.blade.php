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
                            <form action="{{route('admins.publishers.update',$publisher->id)}}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Tên xuất bản</label>
                                            <input type="text" id="name" name="name"
                                                class="form-control" value="{{$publisher->name}}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="mo_ta" class="form-label">Địa chỉ</label>
                                            <input type="text" class="form-control" name="address" value="{{ $publisher->address }}">
                                        </div>   
                                         <div class="mb-3">
                                            <label for="mo_ta" class="form-label">Số điện thoại</label>
                                            <input type="text" class="form-control" name="phone" value="{{ $publisher->phone }}">
                                        </div>                                        
                                    </div>
                                    <div class="d-flex"><button type="submit" class="btn btn-primary">Sửa Lại</button>
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
