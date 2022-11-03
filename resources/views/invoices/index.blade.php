@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')
<div class="container-fluid p-5">
    <div class="row">
        <div class="col-12">
            <h1 class="h1">Facturas</h1>
            <hr class="bg-dark w-100">
        </div>
    </div>
    <div class="row p-2 d-flex mb-3">
        <div class="col m-auto">
        @can('crear-factura')
            <a class="btn btn-primary rounded-circle" href="{{ route('invoices.create') }}">
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
            <table class="table table-striped mt-2 nowrap" style="width: 100%;" id="tableInvoices">
                <thead style="background-color:#ffff">
                    <th style="" hidden>Id</th>
                    <th style="">Código</th>
                    <th style="">Cliente</th>
                    <th style="">Fecha</th>
                    <th style="">Estado</th>
                    <th style="">Acciones</th>
                </thead>
                <tbody>
                    @foreach($invoices as $invoice)
                    <tr>
                        <td hidden>{{$invoice->id}}</td>
                        <td>{{$invoice->voucher_serie}}</td>
                        <td>{{$invoice->client->name}}</td>
                        <td>{{$invoice->voucher_date}}</td>
                        <td><h5><span class="badge badge-dark">{{$invoice->voucher_status->name}}</span></h5></td>
                        <td>
                        @can('ver-factura')
                            <a href="{{route('invoices.show',$invoice->id)}}" class="btn btn-success"><i class="fas fa-eye"></i></a>
                        @endcan
                        </td>
                    </tr>
                    @endforeach()
                </tbody>
            </table>
        </div>
        </div>
    </div>
</div>
@stop

@section('css')

@stop

@section('js')
<script>
    $(document).ready(function() {
        $('#tableInvoices').DataTable({
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json"
            },
            responsive: true
        });
    });
</script>

@if (session('success') == 'ok')
<script>
    Swal.fire(
        'Creada!',
        'Factura creada',
        'success'
    )
</script>
@endif

@stop