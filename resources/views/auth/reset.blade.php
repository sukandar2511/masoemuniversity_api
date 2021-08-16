<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Recover Password</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css')}}">
  </head>
  <body class="hold-transition login-page">
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__wobble" src="{{ asset('logo.jpg')}}" alt="AdminLTELogo" height="60" width="60">
    </div>
    <div class="login-box">
      <div class="card">
        <div class="card-body login-card-body">
          <div class="login-logo">
            <a href="#">
                <div style="margin-top: -1.4rem;">
                    <img src="{{ asset('img/MU.png') }}" alt="Logo 1" class="img-fluid" style="max-width: 50%;">
                </div>
            </a>
          </div>
          <p class="login-box-msg">Ubah password baru sekarang.</p>

          <form action="login.html" method="post">
            <div class="input-group mb-3">
              <input type="password" class="form-control" placeholder="Password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" class="form-control" placeholder="Confirm Password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">Ubah password</button>
              </div>
            </div>
          </form>

          <p class="mt-3 mb-1">
            <a href="login.html"><b>Login</b></a>
          </p>
        </div>

      </div>
    </div>

    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js')}}"></script>
  </body>
</html>
