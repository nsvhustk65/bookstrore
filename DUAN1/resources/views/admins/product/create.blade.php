@extends('admins.master')
@section('css')
    <link href="{{ asset('admin/libs/quill/quill.core.js') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/libs/quill/quill.snow.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/libs/quill/quill.bubble.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="content">
        <!-- Start Content-->
        <div class="container-xxl">
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Product</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <h5 class="card-title mb-0">create product</h5>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <form method="POST" action="{{ route('admins.products.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-4 mb-4">
                                        <div class="mb-3">
                                            <label for="ma_san_pham" class="form-label">Mã sản phẩm</label>
                                            <input type="text" id="ma_san_pham" name="ma_san_pham"
                                                class="form-control @error('ma_san_pham')
                                                is-invalid @enderror"
                                                value="{{ old('ma_san_pham') }}">
                                            @error('ma_san_pham')
                                                <p>{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="ten_san_pham" class="form-label">Tên sản phẩm</label>
                                            <input type="text" id="ten_san_pham" name="ten_san_pham"
                                                class="form-control @error('ten_san_pham')
                                                is-invalid @enderror"
                                                value="{{ old('ten_san_pham') }}">
                                            @error('ten_san_pham')
                                                <p>{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="gia_san_pham" class="form-label">Giá sản phẩm</label>
                                            <input type="number" id="gia_san_pham" name="gia_san_pham"
                                                class="form-control @error('gia_san_pham')
                                                is-invalid @enderror"
                                                value="{{ old('gia_san_pham') }}">
                                            @error('gia_san_pham')
                                                <p>{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="gia_khuyen_mai" class="form-label">gia khuyen mai</label>
                                            <input type="text" id="gia_khuyen_mai" name="gia_khuyen_mai"
                                                class="form-control @error('gia_khuyen_mai')
                                                is-invalid @enderror"
                                                value="{{ old('gia_khuyen_mai') }}">
                                            @error('gia_khuyen_mai')
                                                <p>{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="category_id" class="form-label">Danh mục</label>
                                            <select name="category_id" class="form-select">
                                                <option value="" selected>--Chọn danh mục--</option>
                                                @foreach ($listCategory as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ old('category_id') == $item->id ? 'selected' : '' }}>
                                                        {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="author_id" class="form-label">Tác giả</label>
                                            <select name="author_id" class="form-select">
                                                @foreach ($listAuthor as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ old('author_id') == $item->id ? 'selected' : '' }}>
                                                        {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="publisher_id" class="form-label">nhà xuất bản</label>
                                            <select name="publisher_id" class="form-select">
                                                @foreach ($listPublisher as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ old('publisher_id') == $item->id ? 'selected' : '' }}>
                                                        {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="so_luong" class="form-label">so luong</label>
                                            <input type="number" id="so_luong" name="so_luong"
                                                class="form-control @error('so_luong')
                                                is-invalid @enderror"
                                                value="{{ old('so_luong') }}">
                                            @error('so_luong')
                                                <p>{{ $message }}</p>
                                            @enderror
                                        </div>


                                    </div>

                                    <div class="col-lg-8 ">

                                        <div class="mb-3">
                                            <label for="ngay_nhap" class="form-label">Ngày nhập</label>
                                            <input type="date" id="ngay_nhap" name="ngay_nhap"
                                                class="form-control @error('ngay_nhap')
                                                is-invalid @enderror"
                                                value="{{ old('ngay_nhap') }}">
                                            @error('ngay_nhap')
                                                <p>{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="mo_ta_ngan" class="form-label">Mô Tả</label> <br>
                                            <textarea name="mo_ta" id="" rows="5" class="form-control"></textarea>
                                            @error('mo_ta_ngan')
                                                <p>{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="image" class="form-label">hinh anh</label>
                                            <input type="file" id="image" name="image" class="form-control"
                                                onchange="showIamge(event)">
                                            <img id="img_product" alt="hinh anh" style="width:150px; display: none">
                                        </div>
                                        <div class="mb-3">
                                            <label for="hinh_anh" class="form-label">Album hinh anh</label>
                                            <i id="add-row"
                                                class="mdi mdi-plus text-muted fs-18 rounded-2 border ms-3 p-1"
                                                style="cursor: pointer"></i>
                                            <table class="table align-middle table-nowrap mb-0">
                                                <tbody id="image-table-body">
                                                    <tr>
                                                        <td class="d-flex align-items-center">
                                                            <img id="preview_0"
                                                                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS0Wr3oWsq6KobkPqznhl09Wum9ujEihaUT4Q&s"
                                                                alt="hinh anh" style="width:50px" class="me-3">
                                                            <input type="file" id="hinh_anh"
                                                                name="list_hinh_anh[id_0]" class="form-control"
                                                                onchange="previewImage(this,0)">
                                                        </td>
                                                        <td class="">
                                                            <i class="mdi mdi-delete text-muted fs-18 rounded-2 border p-1"
                                                                style="cursor: pointer" onclick="removeRow(this)"></i>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="d-flex"><button type="submit" class="btn btn-primary">thêm mới</button>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var rowCount = 1;
            document.getElementById('add-row').addEventListener('click', function() {
                var tableBody = document.getElementById('image-table-body')
                var newRow = document.createElement('tr');
                newRow.innerHTML = ` 
                    <td class="d-flex align-items-center">
                        <img id="preview_${rowCount}" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS0Wr3oWsq6KobkPqznhl09Wum9ujEihaUT4Q&s" alt="hinh anh"
                            style="width:50px" class="me-3">
                        <input type="file" id="hinh_anh" name="list_hinh_anh[id_${rowCount}]"
                            class="form-control" onchange="previewImage(this,${rowCount})">                                                            
                    </td>
                    <td class="">
                        <i class="mdi mdi-delete text-muted fs-18 rounded-2 border p-1" 
                        style="cursor: pointer" onclick="removeRow(this)"></i>
                    </td>
                    `;
                tableBody.appendChild(newRow);
                rowCount++;
            });
        })

        function previewImage(input, rowIndex) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById(`preview_${rowIndex}`).setAttribute('src', e.target.result)
                }
                reader.readAsDataURL(input.files[0])
            }
        }
        function removeRow(item){
            var row = item.closest('tr');
            row.remove();
        }
    </script>
@endsection
