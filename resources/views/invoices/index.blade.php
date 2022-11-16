@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')
<div class="container-fluid p-5">
    <div class="row">
        <div class="col-12">
            <h1>Facturas</h1>
            <hr class="bg-dark w100">
        </div>
    </div>
    <div class="row p-2 d-flex mb-3">
        <div class="col m-auto d-flex  justify-content-start">
            @can('crear-factura')
            <a class="btn btn-primary mb-3" href="{{ route('invoices.create') }}"><i class="fas fa-plus"></i></a>
            @endcan
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <table class="table table-striped mt-2 nowrap" style="width: 100%;" id="tableInvoices">
                <thead style="background-color:#ffff">
                    <th style="">Id</th>
                    <th style="">Código</th>
                    <th style="">Cliente</th>
                    <th style="">Fecha</th>
                    <th style="">Estado</th>
                    <th style="">Acciones</th>
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
                    render: function(data) {
                        if (data == 'No Enviado') {
                            return `<span class="badge badge-dark">${data}</span>`;
                        } else {
                            return `<span class="badge badge-success">${data}</span>`;
                        }
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
@if (session('enviado') == 'ok')
<script>
    Swal.fire(
        'Enviada!',
        'Factura enviada',
        'success'
    )
</script>
@endif

@stop