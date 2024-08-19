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
                        <form action="{{route('menus.store')}}" method="post" >
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên Menu</label>
                                <input type="text"
                                       class="form-control"
                                       name="name"
                                       placeholder="Nhập vào tên Menu"
                                >
                            </div>
                            <div class="form-group">
                                <label >Chọn Menu Cha</label>
                                <select class="form-control" name="parent_id">
                                    <option value="0">Chọn Menu Cha</option>
                                    {!! $optionSelect !!}
                                </select>
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
