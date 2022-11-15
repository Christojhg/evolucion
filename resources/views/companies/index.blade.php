@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')
<div class="container-fluid p-5">
    <div class="row">
        <div class="col-12">
            <h1>Empresa</h1>
            <hr class="bg-dark w100">
        </div>
    </div>
    
    <div class="row">
        <div class="col-12">
            @if($count > 0)

            @else
            @can('crear-empresa')
            <div class="row p-2 d-flex mb-3">
                <div class="col m-auto d-flex justify-content-start">
                    <a href="{{route('companies.create')}}" class="btn btn-success mb-3"><i class="fas fa-plus"></i></a>
                </div>
            </div>
            @endcan
            @endif
            <table class="table table-striped mt-2 nowrap" style="width:100%;" id="tableCompany">
                <thead style="background-color:#ffff">
                    <th hidden>ID</th>
                    <th style="">Nombre</th>
                    <th style="">RUC</th>
                    <th style="">Email</th>
                    <th style="">Ciudad</th>
                    <th style="">Telefono</th>
                    <th style="">Acción</th>
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
                            <a href="{{route('companies.show', $comp->id)}}" class="btn btn-warning"><i class="fas fa-eye"></i></a>
                            @endcan

                            @can('editar-empresa')
                            <a href="{{route('companies.edit', $comp->id)}}" class="btn btn-info"><i class="fas fa-edit"></i></a>
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