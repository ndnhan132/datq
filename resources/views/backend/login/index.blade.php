<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/public/template/css/main.css') }}">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css"
        href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Đăng nhập tài khoản</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <section class="material-half-bg">
        <div class="cover"></div>
    </section>
    <section class="login-content">
        <div class="logo">
            <a href="{{ route('home') }}" style="color: #004a43; text-decoration: underline;">
                <h1>Tanhongfood.com</h1>
            </a>
        </div>
        <div class="login-box">
            <form class="login-form" action="{{ route('account.postLogin') }}" method="POST">
                @csrf
                <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>Đăng nhập</h3>
                <div class="form-group">
                    <label class="control-label">Tài khoản</label>
                    <input class="form-control" type="text" placeholder="Tài khoản" autofocus name="username" value="adminnhan">
                </div>
                <div class="form-group">
                    <label class="control-label">Mật khẩu</label>
                    <input class="form-control" type="password" placeholder="Mật khẩu" name="password" value="T@#123456">
                </div>
                <div class="form-group">
                    <div class="utility">
                        <div class="animated-checkbox">
                            <label>
                                <input type="checkbox" name="remember"><span class="label-text">Ghi nhớ đăng nhập</span>
                            </label>
                        </div>
                        <p class="semibold-text mb-2"><a href="#" data-toggle="flip">Quên mật khẩu ?</a></p>
                    </div>
                </div>
                <div class="form-group btn-container">
                    <button class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>Đăng
                        nhập</button>
                </div>
            </form>
            <form class="forget-form" action="index.html">
                <h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>Forgot Password ?</h3>
                <div class="form-group">
                    <label class="control-label">EMAIL</label>
                    <input class="form-control" type="text" placeholder="Email">
                </div>
                <div class="form-group btn-container">
                    <button class="btn btn-primary btn-block"><i class="fa fa-unlock fa-lg fa-fw"></i>RESET</button>
                </div>
                <div class="form-group mt-3">
                    <p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i>
                            Back to Login</a></p>
                </div>
            </form>
        </div>
    </section>
    <!-- Essential javascripts for application to work-->
    <script src="{{ asset('/public/template/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('/public/template/js/popper.min.js') }}"></script>
    <script src="{{ asset('/public/template/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/public/template/js/main.js') }}"></script>



    <!-- The javascript plugin to display page loading on top-->
    <script src="{{ asset('/public/template/js/plugins/pace.min.js') }}"></script>

    <script type="text/javascript">
        // Login Page Flipbox control
        $('.login-content [data-toggle="flip"]').click(function () {
            $('.login-box').toggleClass('flipped');
            return false;
        });
    </script>
</body>

</html>