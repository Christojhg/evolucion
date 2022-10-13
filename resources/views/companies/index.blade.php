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
            @can('crear-empresa')
            <a href="{{route('companies.create')}}" class="btn btn-success mb-3">Crear</a>
            @endcan
            @endif

            <table class="table table-striped mt-2 nowrap" style="width:100%;" id="tableCompany">
                <thead style="background-color:#6777ef">
                    <th hidden>ID</th>
                    <th style="color:#fff;">Nombre</th>
                    <th style="color:#fff;">RUC</th>
                    <th style="color:#fff;">Email</th>
                    <th style="color:#fff;">Ciudad</th>
                    <th style="color:#fff;">Telefono</th>
                    <th style="color:#fff;">Acción</th>
                </thead>
                <tbody>
                    @foreach($company as $comp)
                    <tr>
                        <td hidden>{{$comp->id}}</td>
                        <td>{{$comp->name}}</td>
                        <td>{{$comp->ruc}}</td>
                        <td>{{$comp->email}}</td>
                        <td>{{$comp->city}}</td>
                        <td>{{$comp->phone}}</td>
                        <td>
                            @can('ver-empresa')
                            <a href="{{route('companies.show', $comp->id)}}" class="btn btn-success">Ver</a>
                            @endcan

                            @can('editar-empresa')
                            <a href="{{route('companies.edit', $comp->id)}}" class="btn btn-info">Editar</a>
                            @endcan
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
    $(document).ready(function() {
        $('#tableCompany').DataTable({
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json"
            },
            responsive: true
        });
    });
</script>
@stop