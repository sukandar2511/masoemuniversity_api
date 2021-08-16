<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
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
      {{-- <div class="login-logo">
        <a href="../../index2.html"><b>Masoem </b>University</a>
      </div> --}}
      <div class="card">
        <div class="card-body login-card-body">
          <div class="login-logo">
            <a href="#">
                <div style="margin-top: -1.4rem;">
                    <img src="{{ asset('img/MU.png') }}" alt="Logo 1" class="img-fluid" style="max-width: 50%;">
                </div>
            </a>
          </div>

          <form action="../../index3.html" method="post">
            <div class="input-group mb-3">
              <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}" autocomplete="on" required>
              <div class="input-group-append">
                <div class="input-group-text @error('email') text-danger @enderror">
                    <span class="fas fa-envelope"></span>
                </div>
              </div>
              @error('email')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="input-group mb-3">
              <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" autocomplete="on" required>
              <div class="input-group-append">
                  <div class="input-group-text @error('password') text-danger @enderror">
                      <span class="fas fa-lock"></span>
                  </div>
              </div>
              @error('password')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="row">
                <div class="col-8">
                    <div class="icheck-primary">
                        <input type="checkbox" name="remember">
                        <label for="remember">
                            Ingat Saya
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
              <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
              </div>
            </div>
          </form>
          <p class="mb-1">
            <a href="forgot-password.html"><b>Saya lupa password</b></a>
          </p>
        </div>
      </div>
    </div>
    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js')}}"></script>
  </body>
</html>
