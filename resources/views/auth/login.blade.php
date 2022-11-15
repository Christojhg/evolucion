@extends('layouts.app')
@section('content')
{{-- Contenido --}}
<div class="container p-2 d-flex m-auto justify-content-center align-content-center">
    <div class="row p-5">
        <div class="col p-5 text-center">
            <div class="row">
                <img src="{{asset('/logo_empresa/logob.png')}}" alt="" class="img-fluid">
            </div>
            <form method="POST" action="{{ route('login') }}">
            @csrf
                <div class="row text-center p-2">
                    <div class="col">
                        {{-- <label for="email" class="">{{ __('Email') }}</label> --}}
                        <input id="email" type="email" class="form-control text-center @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="E-mail">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col">
                        {{-- <label for="password" class="">{{ __('Contraseña') }}</label> --}}
                        <input id="password" type="password" class="form-control text-center @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Contraseña">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row p-2">
                    <div class="col text-center">
                        <button type="submit" class="btn btn-primary w-50">
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
@endsection
