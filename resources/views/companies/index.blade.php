@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')
<div class="container">
    <br>
    <div class="card">
        <div class="card-header">
            <h1>Empresa</h1>
        </div>
        <div class="card-body">

            @if($count > 0)

            @else
                <a href="{{route('companies.create')}}" class="btn btn-success mb-3">Crear</a>
            @endif

            <table class="table table-light">
                <thead>
                    <th>Nombre</th>
                    <th>RUC</th>
                    <th>Email</th>
                    <th>Ciudad</th>
                    <th>Telefono</th>
                    <th>Acción</th>
                </thead>
                <tbody>
                    @foreach($company as $comp)
                    <tr>
                        <td>{{$comp->name}}</td>
                        <td>{{$comp->ruc}}</td>
                        <td>{{$comp->email}}</td>
                        <td>{{$comp->city}}</td>
                        <td>{{$comp->phone}}</td>
                        <td>
                            <a href="{{route('companies.show', 1)}}" class="btn btn-info">Ver</a>
                            <a href="{{route('companies.edit', 1)}}" class="btn btn-info">Editar</a>
                        </td>
                    </tr>
                    @endforeach
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