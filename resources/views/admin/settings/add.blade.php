<!-- resources/views/child.blade.php -->

@extends('layouts.admin') <!--kế thừa từ layout admin -->

@section('title')
    <title>Trang Dashboard</title>
@endsection

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('css')
    <link href="{{ asset('AdminLogin/product/add/add.css') }}" rel="stylesheet" />
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('partials.content-header', ['name' => 'Cài Đặt', 'key' => 'Thêm'])
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{--{{route('categories.store')}}--}}" method="post" >
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên Cài Đặt</label>
                                <input type="text"
                                       class="form-control @error('config_key') is-invalid @enderror"
                                       name="config_key"
                                       placeholder="Nhập vào tên cài đặt"
                                >
{{--                                @if($errors->has('name'))--}}
{{--                                    <p class="alert-danger alert alert-danger-alert">{{ $errors->first('name') }}</p>--}}
{{--                                @endif--}}
                            </div>

                            @if(request()->type === 'text')
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá Trị Cài Đặt</label>
                                    <input type="text"
                                           class="form-control @error('config_value') is-invalid @enderror"
                                           name="config_value"
                                           placeholder="Nhập vào Config Value"
                                    >
                                    {{--                                @if($errors->has('name'))--}}
                                    {{--                                    <p class="alert-danger alert alert-danger-alert">{{ $errors->first('name') }}</p>--}}
                                    {{--                                @endif--}}
                                </div>
                            @elseif(request()->type ==='textarea')
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá Trị Cài Đặt</label>
                                    <textarea rows="5"
                                           class="form-control @error('config_value') is-invalid @enderror"
                                           name="config_value"
                                           placeholder="Nhập vào Config Value"
                                    ></textarea>
                                    {{--                                @if($errors->has('name'))--}}
                                    {{--                                    <p class="alert-danger alert alert-danger-alert">{{ $errors->first('name') }}</p>--}}
                                    {{--                                @endif--}}
                                </div>
                            @endif
{{--                            <div class="form-group">--}}
{{--                                <label >Chọn Danh Mục</label>--}}
{{--                                <select class="form-control" name="parent_id">--}}
{{--                                    <option value="0">Chọn Danh Mục</option>--}}
{{--                                    {!! $htmlOption !!}--}}
{{--                                </select>--}}
{{--                            </div>--}}

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
