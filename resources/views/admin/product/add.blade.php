<!DOCTYPE html>

<html lang="en">
@extends('layouts.admin') <!--kế thừa từ layout admin -->

@section('title')
    <title>Trang Thêm Sản Phẩm</title>
@endsection
{{--using select2 CDN, sử dụng select2 băằng cách lên gg search copy và patse link vào yield css và js--}}
{{--@section('tinyMCE')--}}
{{--    <base href="http://banhang.ngoc.in:8888/public/admin/create">--}}
{{--@endsection--}}
<link href="vendor/select2/dist/css/select2.min.css" rel="stylesheet" />
<script src="vendor/select2/dist/js/select2.min.js"></script>
@section('css')

<link href="{{ asset('AdminLogin/product/add/add.css') }}" rel="stylesheet" />
<link href="{{asset('vendor/select2/select2.min.css')}}" rel="stylesheet" />
@endsection

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('partials.content-header', ['name' => 'Sản Phẩm', 'key' => 'Thêm'])

        <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data" >
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
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
                                       class="form-control-file"
                                       name="feature_image_path"
                                >
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Ảnh Sản Phẩm</label>
                                <input type="file"
                                       multiple
   {{--                                multiple để chọn nhiều ảnh--}}
                                       class="form-control-file"
                                       name="image_path[]"
                                >
                            </div>
                            <div class="form-group">
                                <label >Chọn Danh Mục</label>
                                <select class="form-control select2_init" name="category_id">
                                    <option value="">Chọn Danh Mục</option>
                                    {!! $htmlOption !!}
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Chọn Tags Sản Phẩm</label>
                                <select name="tags[]"  class="form-control tags tags_select_choose" multiple="multiple">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Nội Dung Sản Phẩm</label>
                            <textarea class="form-control tinymce_editor_init" name="contents" rows="8"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('js')
    <script src="{{ asset('AdminLogin/product/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
    <script src="{{ asset('AdminLogin/product/add/add.js') }}"></script>
@endsection
