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
                        <h1>Nuevo Rol</h1>
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
                        <form action="{{route('roles.store')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="nombreRol">Nombre</label>
                                        <input type="text" name="name" class="form-control" id="nombreRol" placeholder="Nombre">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="permisosRol">Permisos</label>
                                        <br>
                                        @foreach(array_chunk($permission, 4) as $chunk)
                                        <div class="row">
                                            @foreach($chunk as $value)
                                            <div class="col-md-3">
                                                <label>{{ Form::checkbox('permission[]', $value['id'], false, array('class' => 'name')) }}
                                                    {{ $value['name'] }}</label>
                                                <br />
                                            </div>

                                            @endforeach
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Guardar</button>
                                <a class="btn btn-danger" href="{{route('roles.index')}}">Regresar</a>
                            </div>
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