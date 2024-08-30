<!-- resources/views/child.blade.php -->

@extends('layouts.admin') <!--kế thừa từ layout admin -->

@section('title')
    <title>Trang Product</title>
@endsection

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('partials.content-header', ['name' => 'Sản Phẩm', 'key' => 'Danh Sách'])
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ route('product.create') }}" class="btn btn-success float-left m-2">ADD</a>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Tên Sản Phẩm</th>
                                <th scope="col">Giá Sản Phẩm</th>
                                <th scope="col">Hình Ảnh</th>
                                <th scope="col">Danh Mục</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($products as $adminproduct)
                                <tr >
                                    <th scope="row">{{ $adminproduct->id }}</th>
                                    <td >{{ $adminproduct->name }}</td>
                                    <td>{{ number_format($adminproduct->price) }} vnđ</td>
                                    <td> <img src="{{ $adminproduct->feature_image_path }}" alt="" style="width: 150px; height: 150px;object-fit: cover "> </td>
                                    <td>{{ optional($adminproduct->category)->name }}</td>{{--  //sử dụng optional để tránh lỗi khi không có category thì sẽ trả name về null--}}
                                    <td>
                                        <a href="{{route('product.edit', ['id' => $adminproduct->id]) }}" class="btn btn-default"> EDIT </a>
                                        <a href="{{route('product.delete', ['id' => $adminproduct->id]) }}" class="btn btn-danger"> DELETE </a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        {{ $products->links() }}
                    </div>

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
