<!-- resources/views/child.blade.php -->

@extends('layouts.admin') <!--kế thừa từ layout admin -->

@section('title')
    <title>Trang Dashboard</title>
@endsection

@section('css')
    <link href ="{{ asset('AdminLogin/Slider/edit.css') }}" rel="stylesheet" />
@endsection

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('partials.content-header', ['name' => 'Slider', 'key' => 'Thêm'])
        <!-- /.content-header -->
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{route('slider.update', ['id' => $sliders->id])}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên Slider</label>
                                <input type="text"
                                       class="form-control @error('name') is-invalid @enderror"
                                       name="name"
                                       value="{{$sliders->name}}"
                                       placeholder="Nhập vào tên Slider"
                                >
                                @if($errors->has('name'))
                                    <p class="alert-danger alert alert-danger-alert">{{ $errors->first('name') }}</p>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Mô tả Slider</label>
                                <textarea
                                    class="form-control @error('description') is-invalid @enderror"
                                    name="description"
                                    rows="4">{{$sliders->description}}</textarea>
                                @if($errors->has('description'))
                                    <p class="alert-danger alert alert-danger-alert">{{ $errors->first('description') }}</p>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Chọn hình ảnh</label>
                                <input type="file"
                                       class="form-control @error('image_path') is-invalid @enderror"
                                       name="image_path"
                                >
                                <div class="image-container">
                                    <img class="feature-image img-slider d-block" src="{{$sliders->image_path}}"/>
                                </div>
                                @if($errors->has('image_path'))
                                    <p class="alert-danger alert alert-danger-alert">{{ $errors->first('image_path') }}</p>
                                @endif
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
