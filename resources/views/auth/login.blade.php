<html lang="ar">

<head>
    <!-- Meta Tags
        ======================-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="">
    <meta name="copyright" content="">

    <!-- Title Name
        ================================-->
    <title>Salafni</title>

    <!-- Fave Icons
        ================================-->
    <link rel="shortcut icon" href="{{ asset('admin-assets/images/fav-icon.png') }}">

    <!-- Css Base And Vendor
        ===================================-->
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
        integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/picker/picker.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/uppy/uppy.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/datatable/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/select/select-min.css') }}">

    <!-- Site Css
        ====================================-->
    <link rel="stylesheet" href="{{ asset('admin-assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/css/rtl.css') }}">

    <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>

<body class="login-wrap">
    <form class="center-height" method="post" action="{{ route('login') }}">
        @csrf
        <div class="form-title">
            <i class="fa fa-lock"></i>
            سجل دخول لحسابك الشخصي
        </div>
        <div class="form-group">
            <label>البريد الإلكتروني</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}" autocomplete="email" autofocus>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label>الرقم السري </label>
            <input type="password" class="form-control  @error('password') is-invalid @enderror" name="password" />

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group text-center">
            <button type="submit" class="custom-btn">
                تسجيل دخول
            </button>
        </div>
        <!--End Form cont-->
        {{-- <a href="{{ route('register') }}">إنشاء حساب جديد ؟</a> --}}
    </form>
    <!--End Form-->
    <div class="loader">
        <div class="spinner">
            <div class="dot1"></div>
            <div class="dot2"></div>
        </div>
    </div>
    <!-- JS Base And Vendor
        ==========================================-->
    <script src="{{ asset('admin-assets/vendor/jquery/jquery.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="{{ asset('admin-assets/vendor/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin-assets/vendor/uppy/uppy.min.js') }}"></script>
    <script src="{{ asset('admin-assets/vendor/picker/moment.js') }}"></script>
    <script src="{{ asset('admin-assets/vendor/picker/date_range_picker.js') }}"></script>
    <script src="{{ asset('admin-assets/vendor/picker/timepicker.js') }}"></script>
    <script src="{{ asset('admin-assets/vendor/select/select2.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
    <script src="{{ asset('admin-assets/vendor/datatable/datatables.min.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
    <script src="{{ asset('admin-assets/js/main.js') }}"></script>
</body>

</html>
