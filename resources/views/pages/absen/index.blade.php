<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>APLIKASI INVENTARIS | Login</title>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="{{asset('assets/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/vendors/line-awesome/css/line-awesome.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/img/favicon.png')}}" rel="shortcut icon">
    <link href="{{asset('assets/vendors/themify-icons/css/themify-icons.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/vendors/animate.css/animate.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/vendors/toastr/toastr.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/vendors/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('assets/css/sweetalert.css')}}">
    <!-- PLUGINS STYLES-->
    <!-- THEME STYLES-->
    <link href="{{asset('assets/css/main.min.css')}}" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->
    <style>
        body {
            background-repeat: no-repeat;
            background-size: cover;
            background-image: url('./assets/img/absen.jpg');
        }

        .cover {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: rgba(117, 54, 230, .1);
        }

        .login-content {
            max-width: 400px;
            margin: 100px auto 50px;
        }

        .auth-head-icon {
            position: relative;
            height: 60px;
            width: 60px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            background-color: #fff;
            color: #5c6bc0;
            box-shadow: 0 5px 20px #d6dee4;
            border-radius: 50%;
            transform: translateY(-50%);
            z-index: 2;
        }
    </style>
</head>

<body>
    <div class="cover"></div>
    <div class="ibox login-content">
        <div class="text-center">
            <span class="auth-head-icon"><i class="la la-user"></i></span>
        </div>
        <?php $date = getdate();
        $jam = $date['hours'];
        ?>
        <form class="ibox-body" id="login-form" action="{{url('/absen')}}" method="POST">
            @csrf
            <h4 class="font-strong text-center mb-5">Silahkan Absen {{($jam<=12)?'Masuk':'Pulang'}}</h4>
            <div class="form-group mb-4">
                <label class="control-label">Pegawai</label>
                <select class="select2 show-tick form-control required" name="pegawai" data-style="btn-inverse" required>
                    <option value="">Pilih Pegawai</option>
                    @foreach($pegawai as $dt)
                    <option value="{{$dt->id}}"> {{$dt->nama}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-4">

                <input class="form-control form-control-line" type="password" name="pin" placeholder="NOMOR PIN" autocomplete="off" required>
            </div>
            @if($errors->any())
            <div class="alert alert-pink alert-dismissable fade show has-icon">
                <i class="la la-info-circle alert-icon"></i>
                <button class="close" data-dismiss="alert" aria-label="Close"></button>
                Periksa kembali data anda!
            </div>
            @endif
            <br>
            <div class="text-center mb-4">
                <button class="btn btn-primary btn-rounded btn-block">ABSEN</button>
            </div>
            <h6 class="font-strong text-center mb-5">APLIKASI ABSENSI &copy {{date('Y')}}</h6>
        </form>
    </div>
    <!-- BEGIN PAGA BACKDROPS-->
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>
    <!-- CORE PLUGINS-->
    <script src="{{asset('assets/vendors/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('assets/vendors/popper.js/dist/umd/popper.min.js')}}"></script>
    <script src="{{asset('assets/vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/vendors/metisMenu/dist/metisMenu.min.js')}}"></script>
    <script src="{{asset('assets/vendors/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
    <script src="{{asset('assets/vendors/jquery-idletimer/dist/idle-timer.min.js')}}"></script>
    <script src="{{asset('assets/vendors/toastr/toastr.min.js')}}"></script>
    <script src="{{asset('assets/vendors/jquery-validation/dist/jquery.validate.min.js')}}"></script>
    <script src="{{asset('assets/vendors/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{asset('assets/js/sweetalert.js')}}"></script>
    @include('sweetalert::alert')
    <!-- PAGE LEVEL PLUGINS-->
    <!-- CORE SCRIPTS-->
    <script src="{{asset('assets/js/app.min.js')}}"></script>
    <!-- PAGE LEVEL SCRIPTS-->
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
        $(function() {
            $('#login-form').validate({
                errorClass: "help-block",
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true
                    }
                },
                highlight: function(e) {
                    $(e).closest(".form-group").addClass("has-error")
                },
                unhighlight: function(e) {
                    $(e).closest(".form-group").removeClass("has-error")
                },
            });
        });
    </script>
</body>

</html>