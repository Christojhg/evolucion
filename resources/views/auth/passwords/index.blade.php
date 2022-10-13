@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')
<div class="container">
    <br>
    <div class="card">
        <div class="card-header">
            <h1>Cambio de Contraseña</h1>
        </div>
        <div class="card-body">
            @if (session('error'))
            <div class="alert alert-dark alert-dismissible fade show" role="alert">
                <strong>¡Revise los campos!</strong>
                <span class="badge badge-danger">{{ session('error') }}</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @if ($errors->any())
            <div class="alert alert-dark alert-dismissible fade show" role="alert">
                <strong>¡Revise los campos!</strong>
                @foreach ($errors->all() as $error)
                <span class="badge badge-danger">{{ $error }}</span>
                @endforeach
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <form action="{{route('changePassword')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <label for="actualPassword">Contraseña Actual</label>
                            <input type="password" name="actualUserPassword" class="form-control" id="actualPassword" placeholder="Contraseña Actual">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <label for="newPassword">Nueva Contraseña</label>
                            <input type="password" name="newPassword" class="form-control" id="newPassword" placeholder="Nueva Contraseña">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <label for="newPassword_confirm">Confirmar Contraseña</label>
                            <input type="password" name="newPassword_confirmation" class="form-control" id="newPassword_confirmation" placeholder="Confirmar Contraseña">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-info">Cambiar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('css')

@stop

@section('js')
@if (session('success') == 'ok')
<script>
    Swal.fire(
        'Exito!',
        'Su contraseña ha sido cambiada',
        'success'
    )
</script>
@endif

@stop