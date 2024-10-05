<!-- resources/views/child.blade.php -->

@extends('layouts.admin') <!--kế thừa từ layout admin -->

@section('title')
    <title>Trang Dashboard</title>
@endsection

@section('css')
    <link href="{{ asset('AdminLogin/product/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" />
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('partials.content-header', ['name' => 'Slider', 'key' => 'Danh Sách'])
        <!-- /.content-header -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{route('slider.create')}}" class="btn btn-success float-left m-2">ADD</a>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Description</th>
                                <th scope="col">Hình Ảnh</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                                @foreach ($sliders as $slider)
                                    <tr>
                                        <th scope="row">{{ $slider->id }}</th>
                                        <td>{{ $slider->description }}</td>
                                        <td>
                                            <img src="{{ $slider->image_path }}" alt="" style="width: 150px; height: 150px;object-fit: cover ">
                                        </td>
                                        <td>
                                            <a href="{{route('slider.edit', ['id' => $slider->id]) }}" class="btn btn-default"> EDIT </a>
                                            <a href=""
                                               data-url="{{route('slider.delete', ['id' => $slider->id]) }}"
                                               class="action-delete btn btn-danger"> DELETE </a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        {{ $sliders->links() }}
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
    <script src="{{ asset('AdminLogin/product/sweet-alert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('AdminLogin/product/index/alert.js') }}"></script>
@endsection
