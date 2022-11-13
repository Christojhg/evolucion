@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')
<section class="section">
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <br>
                <div class="card">
                    <div class="card-header">
                        <h1>Nuevo Usuario</h1>
                    </div>
                    <div class="card-body">

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
                        <form action="{{route('users.store')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="nombreUsuario">Nombre</label>
                                        <input type="text" name="name" class="form-control" value="{{old('name')}}" id="nombreUsuario" placeholder="Nombre">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="emailUsuario">Email</label>
                                        <input type="email" name="email" class="form-control" value="{{old('email')}}" id="emailUsuario" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="direccionUsuario">Dirección</label>
                                        <input type="text" name="address" class="form-control" value="{{old('address')}}" id="direccionUsuario" placeholder="Dirección">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="docUsuario">Doc. Identidad</label>
                                        <input type="text" name="doc_id" class="form-control" value="{{old('doc_id')}}" maxlength="8" id="docUsuario" placeholder="DNI">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="telefonoUsuario">Telefono</label>
                                        <input type="text" name="phone" class="form-control" value="{{old('phone')}}" maxlength="9" id="emailUsuario" placeholder="Telefono">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="password">Contraseña</label>
                                        {!! Form::password('password', array('class' => 'form-control', 'placeholder' => 'Contraseña')) !!}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="confirm-password">Confirmar Contraseña</label>
                                        {!! Form::password('confirm-password', array('class' => 'form-control', 'placeholder' => 'Confirmar Contraseña')) !!}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="">Roles</label>
                                        {!! Form::select('roles[]', $roles,[], array('class' => 'form-control')) !!}
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info">Guardar</button>
                            <a class="btn btn-success" href="{{route('users.index')}}">Regresar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    console.log('Hi!');
</script>
@stop