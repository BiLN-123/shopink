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
        @include('partials.content-header', ['name' => 'Cài Đặt', 'key' => 'Danh Sách'])
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{route('settings.create')}}" class="btn btn-success float-left m-2">ADD</a>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Config Key</th>
                                <th scope="col">Config Value</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>

{{--                            @foreach ($menus as $menu)--}}
{{--                                <tr>--}}
{{--                                    <th scope="row">{{ $menu->id }}</th>--}}
{{--                                    <td>{{ $menu->name }}</td>--}}
{{--                                    <td>--}}
{{--                                        <a href="{{route('menus.edit', ['id' => $menu->id]) }}" class="btn btn-default"> EDIT </a>--}}
{{--                                        <a href=""--}}
{{--                                           data-url="{{route('menus.delete', ['id' => $menu->id]) }}"--}}
{{--                                           class="action-delete btn btn-danger"> DELETE </a>--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                            @endforeach--}}

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
{{--                        {{ $menus->links() }}--}}
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
