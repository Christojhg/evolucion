@extends('layouts.app')
@section('content')
{{-- Contenido --}}
<div class="container p-5 mt-5">
    {{-- comentado temporal para colocar imagen  --}}
    {{-- <div class="row">
        <div class="col text-center">
            <h1 class="h1 display-1">
                Bienvenido a tu sistema PYME
            </h1>
        </div>
    </div> --}}
    {{-- fin de comentao temporal --}}
    <div class="row">
        {{-- <div class="card-header">{{ __('Login') }}</div> --}}
        <div class="col-8">
            {{-- <img src="public/img/ping.png" alt="" class="img"> --}}
            <h1 class="h1 display-1 text-primary">
                Bienvenido a tu sistema PYME
            </h1>
        </div>
        <div class="col-4 p-5">
            <form method="POST" action="{{ route('login') }}">
            @csrf
                <div class="row">
                    <div class="mb-3">
                        {{-- <label for="email" class="">{{ __('Email') }}</label> --}}
                        <div class="">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="E-mail">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        {{-- <label for="password" class="">{{ __('Contraseña') }}</label> --}}
                        <div class="">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Contraseña">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="">
                        <button type="submit" class="btn btn-primary w-100">
                            {{ __('Ingresar') }}
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
