<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset("plugins/bootstrap/css/bootstrap.css") }}">
        <script src="{{ asset("plugins/bootstrap/js/bootstrap.js") }}"></script>
        <script src="{{ asset("plugins/jquery/jquery.js") }}"></script>
        <!-- Styles -->


        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="row">
        <div class="container" style="margin-top: 6%;">
            <div class="row">
              <div class="col-md-5 col-12" style="border: 1px solid black;">
                <img src="{{ url("imagen/logo-borde-blanco-2.png") }}" class="img-fluid" style="margin:20px auto; display:block;">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">Correo</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">Contraseña</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0" style="margin-button:10px;">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                Acceder
                            </button>
                        </div>
                    </div>
                    <div style="margin: 40px"></div>
                </form>
              </div>
              <div class="col-md-7 col-12"style="border: 1px solid black;background-image: url('{{asset('imagen/img-inicial-1.jpg')}}');">
                {{-- <img src="imagen/img-inicial-1.jpg" class = "img-responsive"> --}}

              </div>
            </div>
          </div>
    </body>
</html>
