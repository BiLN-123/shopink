<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Login</title>

    <link rel="stylesheet" href="{{asset('AdminLogin/style.css')}}">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <!------ Include the above in your HEAD tag ---------->

</head>
<body>

<div class="login-reg-panel">
    <div class="login-info-box">
        <h2>Bạn đã có tài khoản?</h2>
        <p>Nhấn vào để chuyển sang trang đăng nhập ngay</p>
        <label id="label-register" for="log-reg-show">Login</label>
        <input type="radio" name="active-log-panel" id="log-reg-show"  checked="checked">
    </div>

    <div class="register-info-box">
        <h2>Bạn chưa có tài khoản?</h2>
        <p>Nhấn vào để chuyển sang trang đăng ký ngay</p>
        <label id="label-login" for="log-login-show">Register</label>
        <input type="radio" name="active-log-panel" id="log-login-show">
    </div>

    <div class="white-panel">
        <form id="login-form" class="form" action="" method="post">
            @csrf
            <div class="login-show form-group">
                <h2>LOGIN</h2>
                <input type="text" name="email" placeholder="Email">
                <input type="password" name="password" placeholder="Password">
            </div>
            <div class="login-show form-group" style="margin-top: -13%">
                <label for="remember-me" class="text-info" style="margin-bottom: 15%">Remember me
                    <span>
                        <input id="remember-me" name="remember me" type="checkbox">
                    </span>
                </label><br>
                <input type="submit" name="submit" value="Login">
                <a href="#">Forgot password?</a>
            </div>
        </form>
        <div class="register-show">
            <h1>REGISTER</h1>
            <h3>KHÔNG KHẢ DỤNG</h3>
            <h4>Vui Lòng Liên Hệ Admin Để Được Cấp Tài Khoản</h4>
{{--            <input type="text" placeholder="Email">--}}
{{--            <input type="password" placeholder="Password">--}}
{{--            <input type="password" placeholder="Confirm Password">--}}
{{--            <input type="button" value="Register">--}}
        </div>
    </div>
</div>

<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script src="{{asset('AdminLogin/style.js')}}"></script>

</body>
</html>
