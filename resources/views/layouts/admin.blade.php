<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('title')
    {{-- <!--sử dụng yield để chèn nội dung vào layout--> --}}

    {{-- <!-- Google Font: Source Sans Pro --> --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    {{-- <!-- Font Awesome Icons --> --}}
    {{--    @yield('tinyMCE')--}}
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
    {{-- <!-- Theme style --> --}}
    <link rel="stylesheet" href="{{asset('AdminLTE/dist/css/dropdown.css')}}">

    <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}">
    @yield('css')            {{-- <!--sử dụng yield để chèn nội dung vào layout--> --}}
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    {{-- <!-- Navbar --> --}}
    @include('partials.header')
    {{-- <!-- /.navbar --> --}}

    {{-- <!-- Main Sidebar Container --> --}}
    @include('partials.sidebar'){{--  <!--sử dụng include để chèn nội dung vào layout--> --}}

    {{-- <!-- Content Wrapper. Contains page content --> --}}
    @yield('content') {{-- <!--sử dụng yield để chèn nội dung vào layout--> --}}

    {{-- <!-- Main Footer --> --}}
    @include('partials.footer')
</div>


{{-- <!-- jQuery --> --}}
<script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
{{-- <!-- Bootstrap 4 --> --}}
<script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
{{-- <!-- AdminLTE App --> --}}
<script src="{{ asset('AdminLTE/dist/js/adminlte.min.js') }}"></script>
{{--dropdown--}}
<script src="{{asset('AdminLTE/dist/dropdown.js')}}"></script>
@yield('js'){{--  <!--sử dụng yield để chèn nội dung vào layout--> --}}
</body>
</html>


