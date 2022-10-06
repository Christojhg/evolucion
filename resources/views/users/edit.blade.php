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
                        <h1>Editar Usuario</h1>
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
                        <form action="{{route('users.update', $user->id)}}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="nombreUsuario">Nombre</label>
                                        <input type="text" name="name" class="form-control" value="{{old('name', $user->name)}}" id="nombreUsuario" placeholder="Nombre">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="">Roles</label>
                                        {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control')) !!}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="direccionUsuario">Dirección</label>
                                        <input type="text" name="address" class="form-control" value="{{old('address', $user->address)}}" id="direccionUsuario" placeholder="Dirección">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="docUsuario">Doc. Identidad</label>
                                        <input type="text" name="doc_id" class="form-control" value="{{old('doc_id', $user->doc_id)}}" id="docUsuario" placeholder="Doc. Identidad">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="telefonoUsuario">Telefono</label>
                                        <input type="text" name="phone" class="form-control" value="{{old('phone', $user->phone)}}" id="emailUsuario" placeholder="Telefono">
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