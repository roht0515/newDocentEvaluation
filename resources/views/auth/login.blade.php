<!DOCTYPE html>
<html lang="en">

<head>
	<title>Iniciar sesion</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="{{ asset('images/icons/upds.ico') }}" />
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/animate/animate.css') }}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/css-hamburgers/hamburgers.min.css') }}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/select2/select2.min.css') }}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
	<!--===============================================================================================-->
	<style>
		strong {
			color: #FF0000;
			font-size: 11px;
		}
	</style>
</head>

<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="{{ asset('images/isologo-color-upds_800x800i.png') }}" alt="IMG">
				</div>

				<form class="login100-form  validate-form " method="POST" action="{{ route('login') }}"
					autocomplete="off">
					@csrf
					<span class="login100-form-title">
						Iniciar Sesion
					</span>

					<div class="wrap-input100">
						<input id="username" class="input100 @error('username') is-invalid  @enderror" type="text"
							name="username" placeholder="Usuario" value="{{ old('username') }}"
							data-validate="Valid email is required: ex@abc.xyz">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
						@error('username')
						<span class="invalid-feedback symbol-input100 validate-input" role="alert">
							<strong color="red">{{ $message }}</strong>

						</span>
						@enderror
					</div>

					<div class="wrap-input100">
						<input id="password" class="input100 @error('password') is-invalid @enderror" type="password"
							name="password" placeholder="Contraseña" data-validate="Password is required">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
						@error('password')
						<span class="invalid-feedback symbol-input100 validate-input " role="alert">
							<strong color="red">{{ $message }}</strong>
						</span>
						@enderror
					</div>

					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn">
							{{ __('Login') }}
						</button>

					</div>


				</form>
			</div>
		</div>
	</div>




	<!--===============================================================================================-->
	<script src="{{ asset('vendor/jquery/jquery-3.2.1.min.js') }}"></script>
	<!--===============================================================================================-->
	<script src="{{ asset('vendor/bootstrap/js/popper.js') }}"></script>
	<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
	<!--===============================================================================================-->
	<script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
	<!--===============================================================================================-->
	<script src="{{ asset('vendor/tilt/tilt.jquery.min.js') }}"></script>
	<script>
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
	<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>

</html>