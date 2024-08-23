<!-- resources/views/child.blade.php -->

@extends('layouts.admin') <!--kế thừa từ layout admin -->

@section('title')
    <title>Trang Thêm Sản Phẩm</title>
@endsection
{{--using select2 CDN, sử dụng select 2 băằng cách lên gg search copy và patse link vào yield css và js--}}
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('partials.content-header', ['name' => 'Sản Phẩm', 'key' => 'Thêm'])
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">

                        <form action="{{route('categories.store')}}" method="post" enctype="multipart/form-data" >
{{--                        do upload ảnh nên sư dụng enctype="multipart/form-data"--}}
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên Sản Phẩm</label>
                                <input type="text"
                                       class="form-control"
                                       name="name"
                                       placeholder="Nhập vào tên sản phẩm"
                                >
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Giá Sản Phẩm</label>
                                <input type="text"
                                       class="form-control"
                                       name="price"
                                       placeholder="Nhập vào giá sản phẩm"
                                >
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Ảnh Đại Diện Sản Phẩm</label>
                                <input type="file"
                                       class="form-control"
                                       name="future_image_path"
                                >
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Ảnh Sản Phẩm</label>
                                <input type="file"
                                       multiple
   {{--                                multiple để chọn nhiều ảnh--}}
                                       class="form-control"
                                       name="image_path[]"
                                >
                            </div>
                            <div class="form-group">
                                <label >Chọn Danh Mục</label>
                                <select class="form-control select2_init" name="parent_id">
                                    <option value="">Chọn Danh Mục</option>
                                    {!! $htmlOption !!}
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Chọn Tags Sản Phẩm</label>
                                <select name="tags[]" class="form-control tags_select_choose" multiple="multiple">

                                </select>
                            </div>
                            <div class="form-group">
                                <label>Nội Dung Sản Phẩm</label>
                                <textarea class="form-control" name="content" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(function () {
            $(".tags_select_choose").select2({
                tags: true,
                tokenSeparators: [',', ' ']
            });
            $(".select2_init").select2({
                placeholder: "Chọn Danh Mục",
                allowClear: true
            });
        });
    </script>
@endsection
