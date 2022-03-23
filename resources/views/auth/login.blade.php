@extends('layouts.login')

@section('content')
<div class="container h-100">
    <div class="row d-flex justify-content-center align-content-center h-100">
        <div class="card card-size my-3 text-white rounded-xl border-0 animated zoomIn card-5">
            <img class="card-img" src="{{asset('/logo.png')}}" alt="Card image">
            <div class="card-img-overlay d-flex justify-content-center align-content-center">
            </div>
            <div class="card-body card-body-login">
           
                    <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
              
                    @csrf

                    <div class="form-group row">
                        @if (request()->get('errors') == '1')
								<div class="alert alert-danger">
									Usuario y/o contraseña invalidos, favor de intentar de nuevo...<br><br>
								</div>
							@endif
                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="Nombre de usuario" value="{{ old('email') }}" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                    </div>

                    <div class="form-group row">
                     
                        <div class="col-md-12">
                            <input id="password" placeholder="Contraseña" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row my-2">
                        <div class="col text-center">
                            <button type="submit" class="btn btn-primary col-12 font-weight-bold card-1">
                                {{ __('Iniciar ') }}<i class="fas fa-sign-in-alt"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>    
</div>
@endsection

