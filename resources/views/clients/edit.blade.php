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
                        <h1>Editar Cliente</h1>
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
                        <form action="{{route('clients.update', $client->id)}}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="nombreCliente">Nombre</label>
                                    <input type="text" name="name" class="form-control" value="{{old('name', $client->name)}}" id="nombreCliente" placeholder="Nombre">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="emailCliente">Email</label>
                                    <input type="email" name="email" class="form-control" value="{{old('email', $client->email)}}" id="emailCliente" placeholder="Email">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="direccionCliente">Dirección</label>
                                    <input type="text" name="address" class="form-control" value="{{old('address', $client->address)}}" id="direccionCliente" placeholder="Dirección">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="docCliente">Doc. Identidad</label>
                                    <input type="text" name="doc_id" class="form-control" value="{{old('doc_id', $client->doc_id)}}" id="docCliente" placeholder="Doc. Identidad">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="telefonoCliente">Telefono</label>
                                    <input type="text" name="phone" class="form-control" value="{{old('phone', $client->phone)}}" id="telefonoCliente" placeholder="Telefono">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info">Guardar</button>
                            <a class="btn btn-success" href="{{route('clients.index')}}">Regresar</a>
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