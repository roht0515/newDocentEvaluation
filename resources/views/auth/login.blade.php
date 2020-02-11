<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
  <meta name="csrf-token" content="{{ csrf_token() }}">
  
  <title>{{ config('app.name', 'docentEvaluation') }} AdminLTE 3 | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Admin</b>LTE</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form id="loginForm" method="POST" action="">
        @csrf
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Usuario">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Contraseña">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

   
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->


<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>


<script>



$(document).on('submit', '#loginForm', function (e) {
    e.preventDefault();

    let form = $(this);
    let formURL = $(form[0]).attr('action');

    let formData = $(form[0]).serialize();

    $.ajax({
        type: "POST",
        url: formURL,
        data: formData,
        cache: false,
        dataType: "JSON",
        success: function (response) {
            if (response.auth) {
                window.location.href = response.intended;
            } else {
                if(!$('#JSONresp').hasClass('show')) {
                    $('#JSONresp').show();
                    $('#JSONresp').addClass('show');
                    $('#JSONresp').html('<strong>Error: </strong>' + response.msgError);
                }
            }
        },
        error: function (err) {
            console.log(err);
        }
    });
});

</script>

</body>
</html>
