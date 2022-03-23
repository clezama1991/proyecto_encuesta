<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container">

        <div class="py-5 text-center">
            <img class="d-block mx-auto mb-4" src="{{ asset('/logo.png') }}" alt="" width="150" height="150">
            <h2>Redes Sociales</h2>
            <p class="lead">Encuesta sobre uso de redes sociales</p>
        </div>

        <div class="flash-message" id="mensaje">
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if (Session::has('alert-' . $msg))
                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#"
                            class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                @endif
            @endforeach
        </div>

        <form action="/guardar_encuesta" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 order-md-2 mb-4">

                    <div class="card shadow p-3 mb-5 bg-white rounded">
                        <h4 class="d-flex justify-content-between align-items-center mb-3">
                            Encuesta
                        </h4>


                        <h6 class="mb-3">Dinos cual es tu Red social Favorita</h6>
                        <div class="d-block my-3">
                            @foreach ($userOrders as $item)
                                <div class="custom-control custom-radio pb-3">
                                    <input id="fav-{{ $item->nombre }}" name="favorita_id" value="{{ $item->id }}"
                                        type="radio" class="custom-control-input" required="">
                                    <label class="custom-control-label" for="fav-{{ $item->nombre }}">
                                        <img src="{{ asset($item->icono) }}" alt="" style="max-width: 20px">
                                        {{ $item->nombre }}</label>
                                </div>
                            @endforeach
                        </div>

                        <h6 class="mb-3 mt-5">Dinos el tiempo promedio que pasas en redes sociales al día</h6>

                        <div class="row">
                            @foreach ($userOrders as $item)
                                <div class="col-md-12 mb-3">
                                    <label for="prom-{{ $item->nombre }}"> <img src="{{ asset($item->icono) }}"
                                            alt="" style="max-width: 20px"> {{ $item->nombre }}</label>
                                    <input type="number" class="form-control" id="prom-{{ $item->nombre }}"
                                        placeholder="Promedio en horas..." max="24" required=""
                                        name="prom[{{ $item->id }}]">
                                </div>
                            @endforeach
                        </div>

                        <button class="btn btn-primary btn-lg btn-block" type="submit">Enviar Respuestas</button>

                    </div>
                </div>
                <div class="col-md-6 order-md-1">
                    <div class="card shadow p-3 mb-5 bg-white rounded">
                        <h4 class="mb-3">Tu Información</h4>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required="">
                                <div class="invalid-feedback">
                                    Valid first name is required.
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="correo">Correo</label>
                            <input type="email" class="form-control" id="correo" name="correo"
                                placeholder="you@example.com"  required="">
                        </div>

                        <div class="mb-3">
                            <label for="edad">Edad</label>
                            <select class="custom-select d-block w-100" id="edad" name="edad" required="">
                                <option value="" selected disabled>Seleccione su Edad...</option>
                                <option value="18-25">18-25</option>
                                <option value="26-33">26-33</option>
                                <option value="34-40">34-40</option>
                                <option value="40+">40+</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="country">Sexo</label>
                            <div class="d-block">
                                <div class="custom-control custom-radio">
                                    <input id="mas" value="m" type="radio" name="sexo" class="custom-control-input"
                                        checked="" required="">
                                    <label class="custom-control-label" for="mas">Masculino</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input id="fem" value="f" type="radio" name="sexo" class="custom-control-input"
                                        required="">
                                    <label class="custom-control-label" for="fem">Femenino</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </form>
        <footer class="my-5 pt-5 text-muted text-center text-small">
            <p class="mb-1">© 2022 Carlos Lezama</p>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="/login">Login</a></li>
            </ul>
        </footer>
    </div>

 
</body>
   <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    
</html>
