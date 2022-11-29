@extends('layouts.app')
@section('content')
{{-- Contenido --}}
<div class="container d-flex m-auto justify-content-center align-content-center">
    <div class="row justify-content-center align-content-center">
        <div class="col-6 text-center bg-light rounded shadow-lg p-3 mb-5 bg-body rounded">
            <div class="row">
                <div class="col p-2 d-flex m-auto justify-content-center align-content-center">
                    <form method="POST" action="{{ route('login') }}">
                    @csrf
                        <div class="row p-2">
                            <div class="">
                                <img src="{{asset('/logo_empresa/logob.png')}}" alt="" class="img-fluid" width="200">
                            </div>
                                <div class="mb-2">
                                    {{-- <label for="email" class="">{{ __('Email') }}</label> --}}
                                    <input id="email" type="email" class="form-control text-center @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="E-mail">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    {{-- <label for="password" class="">{{ __('Contraseña') }}</label> --}}
                                    <input id="password" type="password" class="form-control text-center @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Contraseña">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="p-2">
                                    <button type="submit" class="btn btn-primary w-100">
                                        {{ __('Iniciar Sesión') }}
                                    </button>
                                    <!--@if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif -->
                                </div>
                        </div>
                        <!--<div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div> -->
                    </form>
                </div> 
            </div>
        </div>
    </div>
</div>
@endsection
