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
                    <th style="color:#fff;">Id</th>
                    <th style="color:#fff;">Código</th>
                    <th style="color:#fff;">Cliente</th>
                    <th style="color:#fff;">Fecha</th>
                    <th style="color:#fff;">Estado</th>
                    <th style="color:#fff;">Acciones</th>
                </thead>
                <tbody>

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
            processing: true,
            serverSide: true,
            ajax: "{{route('invoices.index')}}",
            dataType: 'json',
            type: "POST",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'voucher_serie',
                    name: 'voucher_serie'
                },
                {
                    data: 'client.name',
                    name: 'client.name'
                },
                {
                    data: 'voucher_date',
                    name: 'voucher_date'
                },
                {
                    data: 'voucher_status.name',
                    name: 'voucher_status.name'
                },
                {
                    data: 'acciones',
                    name: 'acciones'
                }
            ],
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json"
            },
            responsive: true,
            columnDefs: [{
                    targets: 0,
                    visible: false
                },
                {
                    targets: 4,
                    render: function (data){
                        return `<span class="badge badge-dark">${data}</span>`;
                    }
                }
            ]
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