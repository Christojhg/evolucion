@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')
<div class="container">
    <br>
    <div class="card">
        <div class="card-header">
            <h1>Clientes</h1>
        </div>
        <div class="card-body">

            @can('crear-cliente')
            <a class="btn btn-success" href="{{route('clients.create')}}">Nuevo Cliente</a>
            @endcan

            <table class="table table-striped mt-2">
                <thead style="background-color:#6777ef">
                    <th style="display: none;">ID</th>
                    <th style="color:#fff;">Nombre</th>
                    <th style="color:#fff;">Email</th>
                    <th style="color:#fff;">Direccion</th>
                    <th style="color:#fff;">Doc</th>
                    <th style="color:#fff;">Telefono</th>
                    <th style="color:#fff;">Acciones</th>
                </thead>
                <tbody>
                    @foreach($clients as $client)
                    <tr>
                        <td hidden>{{$client->id}}</td>
                        <td>{{$client->name}}</td>
                        <td>{{$client->email}}</td>
                        <td>{{$client->address}}</td>
                        <td>{{$client->doc_id}}</td>
                        <td>{{$client->phone}}</td>                        
                        <td>
                            <form action="{{route('clients.destroy', $client->id)}}" class="formDelete" method="POST">
                                @can('editar-cliente')
                                <a class="btn btn-info" href="{{ route('clients.edit',$client->id) }}">Editar</a>
                                @endcan

                                @csrf
                                @method('DELETE')

                                @can('borrar-cliente')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                @endcan
                            </form>
                        </td>
                    </tr>
                    @endforeach()
                </tbody>
            </table>

        </div>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    console.log('Hi!');
</script>
@stop