@extends('adminlte::page')

@section('title', 'Boletas')

@section('content')
<div class="container-fluid p-5">
    <div class="row">
        <div class="col-12">
            <h1>Boletas</h1>
            <hr class="bg-dark w100">
        </div>
    </div>
    <div class="row p-2 d-flex mb-3">
        <div class="col m-auto d-flex justify-content-start">
            @can('crear-boleta')
            <a href="{{route('voucher.create')}}" class="btn btn-primary mb-3"><i class="fas fa-plus"></i></a>
            @endcan
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <table class="table table-striped mt-2 nowrap" style="width:100%;" id="tableBoletas">
                <thead style="background-color:#ffff">
                    <th>Id</th>
                    <th>Codigo</th>
                    <th>Cliente</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </thead>
                <tbody>

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
        $('#tableBoletas').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{route('voucher.index')}}",
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
        'Boleta creada',
        'success'
    )
</script>
@endif

@stop