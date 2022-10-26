@extends('adminlte::page')

@section('title', 'Boletas')

@section('content')
<div class="container">
    <br>
    <div class="card">
        <div class="card-header">
            <h1>Boletas</h1>
        </div>
        <div class="card-body">
        @can('crear-boleta')
        <a href="{{route('voucher.create')}}" class="btn btn-success mb-3">Nuevo Boleta</a>
        @endcan
            
            
            <table class="table table-striped mt-2 nowrap" style="width:100%;" id="tableBoletas">
                <thead style="background-color:#6777ef">
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
