<!-- resources/views/child.blade.php -->

@extends('layouts.admin') <!--kế thừa từ layout admin -->

@section('title')
<title>Trang Dashboard</title>
@endsection

@section('css')
    <link href="AdminLogin/product/sweet-alert2/sweetalert2.min.css" />
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', ['name' => 'Danh Mục', 'key' => 'Danh Sách'])
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
                    <a href="{{ route('categories.create') }}" class="btn btn-success float-left m-2">ADD</a>
                </div>
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Tên Danh Mục</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($categories as $category)
                            <tr>
                                <th scope="row">{{ $category->id }}</th>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <a href="{{route('categories.edit', ['id' => $category->id]) }}" class="btn btn-default"> EDIT </a>
                                    <a href=""
                                       data-url="{{route('categories.delete', ['id' => $category->id]) }}"
                                       class="btn btn-danger action-delete"> DELETE </a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="col-md-12">
                    {{ $categories->links() }}
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
