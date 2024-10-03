<!-- resources/views/child.blade.php -->

@extends('layouts.admin') <!--kế thừa từ layout admin -->

@section('title')
    <title>Trang Dashboard</title>
@endsection

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('partials.content-header', ['name' => 'Menu', 'key' => 'Thêm'])
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{route('slider.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên Slider</label>
                                <input type="text"
                                       class="form-control"
                                       name="name"
                                       placeholder="Nhập vào tên Slider"
                                >
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Mô tả Slider</label>
                                <input type="text"
                                       class="form-control"
                                       name="description"
                                       placeholder="Nhập vào mô tả"
                                >
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Chọn hình ảnh</label>
                                <input type="file"
                                       class="form-control"
                                       name="image_path"
                                >
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
