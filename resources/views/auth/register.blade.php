<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>register</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/adminpro/" />
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('Backend/assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- page css -->
    <link href="{{ asset('Backend/assets/css/pages/login-register-lock.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('Backend/assets/css/style.css') }}" rel="stylesheet">
    
    <!-- You can change the theme colors from here -->
    <link href="{{ asset('Backend/assets/css/colors/default-dark.css') }}" id="theme" rel="stylesheet">
</head>

<body class="card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">ArifMehrab</p>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper" class="pb-5">
        <div class="login-register" style="background-image:url({{ asset('Backend/assets/images/background/login-register.jpg') }});">
            <div class="login-box card m-b-20">
                <div class="card-body">
                    <form class="form-horizontal form-material" id="loginform" method="POST" action="{{ route('register') }}">
                        @csrf
                        <h3 class="box-title m-b-20">Become A Author</h3>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input type="text" placeholder="Name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                         <div class="form-group">
                            <div class="col-xs-12">
                                <input type="number" placeholder="Phone Number" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('name') }}" required autocomplete="phone_number" autofocus>

                                @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input placeholder="Email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input placeholder="Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                 @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input placeholder="Confirm Password" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input placeholder="Address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" autocomplete="address">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input placeholder="About Me" type="text" class="form-control @error('about') is-invalid @enderror" name="about" required autocomplete="about">
                            </div>
                             @error('about')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-group text-center mb-5">
                            <div class="col-xs-12">
                                <button class="btn btn-info btn-lg btn-block btn-rounded text-uppercase waves-effect waves-light" type="submit">Send Info</button>
                            </div>
                        </div>
                        <div class="form-group m-b-0">
                            <div class="col-sm-12 text-center">
                                Already have an account? <a href="{{ route('login') }}" class="text-info m-l-5"><b>Sign In</b></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{ asset('Backend/assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('Backend/assets/plugins/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript">
        $(function() {
            $(".preloader").fadeOut();
        });
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        });
        // ============================================================== 
        // Login and Recover Password 
        // ============================================================== 
        $('#to-recover').on("click", function() {
            $("#loginform").slideUp();
            $("#recoverform").fadeIn();
        });
    </script>
</body>
</html>