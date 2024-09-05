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

{{--        <div class="col-md-12">--}}
{{--            @if ($errors->any())--}}
{{--                <div class="alert alert-danger">--}}
{{--                    <ul>--}}
{{--                        @foreach ($errors->all() as $error)--}}
{{--                            <li>{{ $error }}</li>--}}
{{--                        @endforeach--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            @endif--}}
{{--        </div>--}}
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
                                       class="form-control @error('name') is-invalid @enderror"
                                       name="name"
                                       placeholder="Nhập vào tên sản phẩm"
                                >
                                @if($errors->has('name'))
                                    <p class="alert-danger alert alert-danger-alert"><i class="bi bi-exclamation-triangle"></i>{{ $errors->first('name') }}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Giá Sản Phẩm</label>
                                <input type="text"
                                       class="form-control @error('price') is-invalid @enderror"
                                       name="price"
                                       placeholder="Nhập vào giá sản phẩm"
                                >
                                @if($errors->has('price'))
                                    <p class="alert-danger alert">{{ $errors->first('price') }}</p>
                                @endif
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
                                <select class="form-control select2_init @error('category_id') is-invalid @enderror" name="category_id">
                                    <option value="">Chọn Danh Mục</option>
                                    {!! $htmlOption !!}
                                </select>
                                @if($errors->has('category_id'))
                                    <p class="alert-danger alert">{{ $errors->first('category_id') }}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Chọn Tags Sản Phẩm</label>
                                <select name="tags[]"  class="form-control tags tags_select_choose @error('tags') is-invalid @enderror" multiple="multiple">
                                </select>
                                @if($errors->has('tags'))
                                    <p class="alert-danger alert">{{ $errors->first('tags') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Nội Dung Sản Phẩm</label>
                            <textarea class="form-control tinymce_editor_init @error('contents') is-invalid @enderror" name="contents" rows="8"></textarea>
                        </div>
                        @if($errors->has('contents'))
                            <p class="alert-danger alert">{{ $errors->first('contents') }}</p>
                        @endif
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
