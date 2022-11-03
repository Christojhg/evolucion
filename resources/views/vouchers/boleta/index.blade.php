@extends('adminlte::page')

@section('title', 'Boletas')

@section('content')
<div class="container-fluid p-5">
    <div class="row">
        <div class="col-12">
            <h1 class="h1">Boletas</h1>
            <hr class="bg-dark w-100">
        </div>
    </div>
    <div class="row p-2 d-flex mb-3">
        <div class="col-1 m-auto">
            @can('crear-boleta')
                <a href="{{route('voucher.create')}}" class="btn btn-primary rounded-circle">
                    <i class="fas fa-plus"></i>
                </a>
            @endcan
        </div>
        <div class="col-8 d-flex p-2 m-auto">
            <input type="hidden" class="form-control mx-2 w-50">
        </div>
        <div class="col-2 m-auto">
            <button class="btn btn-success mx-2"><i class="far fa-file-excel"></i></button>
            <button class="btn btn-danger mx-2"><i class="far fa-file-pdf"></i></button>
            <button class="btn btn-primary rounded-circle mx-2"><i class="fas fa-print"></i></button>
        </div>
    </div>
    <div class="row">
        <div class="col-12">   
            <table class="table table-striped mt-2 nowrap" style="width:100%;" id="tableBoletas">
                <thead style="background-color:#ffff">
                    <th hidden>Id</th>
                    <th>Codigo</th>
                    <th>Cliente</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </thead>
                <tbody>
                @foreach($vouchers as $voucher)
                    <tr>
                        <td hidden>{{$voucher->id}}</td>
                        <td>{{$voucher->voucher_serie}}</td>
                        <td>{{$voucher->client->name}}</td>
                        <td><h5><span class="badge badge-dark">{{$voucher->voucher_status->name}}</span></h5></td>
                        <td>{{$voucher->voucher_date}}</td>
                        <td>
                            @can('ver-boleta')
                                <a href="{{route('voucher.show',$voucher->id)}}" class="btn btn-success">Ver</a>
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
    $(document).ready( function () {
        $('#tableBoletas').DataTable({
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json"
            },
            responsive: true
        });
    } );
</script>

@if (session('success') == 'ok')
<script>
    Swal.fire(
        'Creada!',
        'Boleta creada',
        'success'
    )
</script>
@endif

@stop
