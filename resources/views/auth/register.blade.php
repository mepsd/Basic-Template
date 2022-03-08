<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name') }}</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css"
        integrity="sha512-0S+nbAYis87iX26mmj/+fWt1MmaKCv80H+Mbo+Ne7ES4I6rxswpfnC6PxmLiw33Ywj2ghbtTw0FkLbMWqh4F7Q=="
        crossorigin="anonymous" />

    <!-- AdminLTE -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.0.5/css/adminlte.min.css"
        integrity="sha512-rVZC4rf0Piwtw/LsgwXxKXzWq3L0P6atiQKBNuXYRbg2FoRbSTIY0k2DxuJcs7dk4e/ShtMzglHKBOJxW8EQyQ=="
        crossorigin="anonymous" />

    <!-- iCheck -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css"
        integrity="sha512-8vq2g5nHE062j3xor4XxPeZiPjmRDh6wlufQlfC6pdQ/9urJkU07NM0tEREeymP++NczacJ/Q59ul+/K2eYvcg=="
        crossorigin="anonymous" />
    <link rel="icon" href="{{ asset('/favicon.ico') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body class="hold-transition login-page"
    style="background-image: url('{{ asset('storage/img/bg-1.jpg') }}');background-size:100%;">
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ url('/home') }}"><b>{{ config('app.name') }} Admin</b></a>
            <img src="{{ asset('storage/img/user.png') }}" alt="User Image" style="width:80px;height:80px;">
        </div>

        <!-- /.login-logo -->

        <!-- /.login-box-body -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg" style="font-weight:bold;color:#29338d;">Sign up here
                </p>
                @if (Session::has('message'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('message') }}
                    </div>
                @endif
                <form method="post" action="{{ url('/register') }}">
                    @csrf

                    <div class="input-group mb-3">
                        <input type="text" name="name" value="{{ old('name') }}"
                            placeholder="Please enter name"
                            class="form-control @error('name') is-invalid @enderror">
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-user"></span></div>
                        </div>
                        @error('name')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <input type="email" name="email" value="{{ old('email') }}"
                            placeholder="Please enter email"
                            class="form-control @error('email') is-invalid @enderror">
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                        </div>
                        @error('email')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" name="password" placeholder="Password"
                            class="form-control @error('password') is-invalid @enderror">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @error('password')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" name="password_confirmation" placeholder="Type it again"
                            class="form-control @error('password_confirmation') is-invalid @enderror">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @error('password_confirmation')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="form-group mt-4 mb-4">
                        <div class="captcha col-12">
                            <span>{!! captcha_img() !!}</span>
                            <button type="button" class="btn" class="reload" id="reload"
                                style="background-color: #fbdf05;">
                                &#x21bb;
                            </button>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input id="captcha" type="text" class="form-control  @error('captcha') is-invalid @enderror"
                            placeholder="Enter Captcha" name="captcha">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @error('captcha')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror

                    </div>


                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-block"
                                style="background-color:#29338d;color:white;border-radius:30px;">SIGN UP</button>
                        </div>
                        <div class="col-12" style="text-align:center;padding-top:20px;">
                            <a href="{{ url('/login') }}" style="font-weight:bold;color:#29338d;">Do we know you? prove it</a>
                        </div>
                    </div>
            </div>
            </form>
        </div>
    </div>

    </div>
    <!-- /.login-box -->

    <!-- AdminLTE App -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.0.5/js/adminlte.min.js"
        integrity="sha512-++c7zGcm18AhH83pOIETVReg0dr1Yn8XTRw+0bWSIWAVCAwz1s2PwnSj4z/OOyKlwSXc4RLg3nnjR22q0dhEyA=="
        crossorigin="anonymous"></script>

    <script type="text/javascript">
        $('#reload').click(function() {
            $.ajax({
                type: 'GET',
                url: "{{ config('app.url') }}/reload-captcha",
                success: function(data) {
                    $(".captcha span").html(data.captcha);
                }
            });
        });
    </script>

</body>

</html>
