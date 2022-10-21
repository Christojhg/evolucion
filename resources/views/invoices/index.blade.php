@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')
<div class="container">
    <br>
    <div class="card">
        <div class="card-header">
            <h1>Facturas</h1>
        </div>
        <div class="card-body">

            @can('crear-factura')
            <a class="btn btn-success mb-3" href="{{ route('invoices.create') }}">Nueva Factura</a>
            @endcan

            <table class="table table-striped mt-2 nowrap" style="width: 100%;" id="tableInvoices">
                <thead style="background-color:#6777ef">
                    <th style="color:#fff;" hidden>Id</th>
                    <th style="color:#fff;">Código</th>
                    <th style="color:#fff;">Cliente</th>
                    <th style="color:#fff;">Fecha</th>
                    <th style="color:#fff;">Estado</th>
                    <th style="color:#fff;">Acciones</th>
                </thead>
                <tbody>
                    @foreach($invoices as $invoice)
                    <tr>
                        <td hidden>{{$invoice->id}}</td>
                        <td>{{$invoice->voucher_serie}}</td>
                        <td>{{$invoice->client->name}}</td>
                        <td>{{$invoice->voucher_date}}</td>
                        <td>{{$invoice->voucher_status->name}}</td>
                        <td>
                            @can('ver-factura')
                            <a href="{{route('invoices.show',$invoice->id)}}" class="btn btn-success">Ver</a>
                            @endcan
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