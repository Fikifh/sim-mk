<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login SIREKI (Aplikasi Rekap Kinerja)</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
<link rel="icon" type="image/png" href={{ asset("bower_components/Login_v16/images/icons/favicon.ico") }}>
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href={{ asset("bower_components/Login_v16/vendor/bootstrap/css/bootstrap.min.css") }}>
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href={{ asset("bower_components/Login_v16/fonts/font-awesome-4.7.0/css/font-awesome.min.css") }}>
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href={{ asset("bower_components/Login_v16/fonts/Linearicons-Free-v1.0.0/icon-font.min.css") }}>
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href={{ asset("bower_components/Login_v16/vendor/animate/animate.css") }}>
    <!--===============================================================================================-->	
        <link rel="stylesheet" type="text/css" href={{ asset("bower_components/Login_v16/vendor/css-hamburgers/hamburgers.min.css") }}>
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href={{ asset("bower_components/Login_v16/vendor/animsition/css/animsition.min.css") }}>
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href={{ asset("bower_components/Login_v16/vendor/select2/select2.min.css") }}>
    <!--===============================================================================================-->	
        <link rel="stylesheet" type="text/css" href={{ asset("bower_components/Login_v16/vendor/daterangepicker/daterangepicker.css") }}>
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href={{ asset("bower_components/Login_v16/css/util.css") }}>
        <link rel="stylesheet" type="text/css" href={{ asset("bower_components/Login_v16/css/main.css") }}>
    <!--===============================================================================================--></head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url( {{ asset('bower_components/Login_v16/images/bg-01.jpg') }} );">
			<div class="wrap-login100 p-t-30 p-b-50">
				<span class="login100-form-title p-b-41">
					Login SIREKI
				</span>
				<form class="login100-form validate-form p-b-33 p-t-5" method="POST" action="{{ route('login') }}">
                @csrf
					<div class="wrap-input100 validate-input" data-validate = "Enter Email">                        
                        <input id="email" type="email"  placeholder="Email" class="input100 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
						<span class="focus-input100" data-placeholder="&#xe82a;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">                        
                        <input id="password" type="password"  placeholder="Password" class="input100 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
						<span class="focus-input100" data-placeholder="&#xe80f;"></span>
					</div>

					<div class="container-login100-form-btn m-t-32">
						<button class="login100-form-btn">
							Login
						</button>
					</div>

				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div><!--===============================================================================================-->
<script src={{ asset("bower_components/Login_v16/vendor/jquery/jquery-3.2.1.min.js") }}></script>
<!--===============================================================================================-->
	<script src={{ asset("bower_components/Login_v16/vendor/animsition/js/animsition.min.js") }}></script>
<!--===============================================================================================-->
	<script src={{ asset("bower_components/Login_v16/vendor/bootstrap/js/popper.js") }}></script>
	<script src={{ asset("bower_components/Login_v16/vendor/bootstrap/js/bootstrap.min.js") }}></script>
<!--===============================================================================================-->
	<script src={{ asset("bower_components/Login_v16/vendor/select2/select2.min.js") }}></script>
<!--===============================================================================================-->
	<script src={{ asset("bower_components/Login_v16/vendor/daterangepicker/moment.min.js") }}></script>
	<script src={{ asset("bower_components/Login_v16/vendor/daterangepicker/daterangepicker.js") }}></script>
<!--===============================================================================================-->
	<script src={{ asset("bower_components/Login_v16/vendor/countdowntime/countdowntime.js") }}></script>
<!--===============================================================================================-->
	<script src={{ asset("bower_components/Login_v16/js/main.js") }}></script>

</body>
</html>