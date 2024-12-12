@extends('admins.master')
@section('content')
    <div class="content">
        <!-- Start Content-->
        <div class="container-xxl">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Banner</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <h5 class="card-title mb-0">Thêm Banner</h5>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <form action="{{route('admins.banner.store')}}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Tiêu đề</label>
                                            <input type="text" id="name" name="title"
                                                class="form-control">
                                        </div>
                                         <div class="mb-3">
                                            <label for="mo_ta" class="form-label">Hình ảnh</label>
                                            <input type="file" id="mo_ta" name="image"
                                                class="form-control" onchange="showIamge(event)">
                                            <img id="img_product" alt="hinh anh" style="width:150px; display: none">
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
 <script>
        function showIamge(event) {
            const img_product = document.getElementById('img_product');
            const file = event.target.files[0];
            const reader = new FileReader();
            reader.onload = function() {
                img_product.src = reader.result;
                img_product.style.display = 'block';
            }
            if (file) {
                reader.readAsDataURL(file)
            }
        }
    </script>
@endsection
