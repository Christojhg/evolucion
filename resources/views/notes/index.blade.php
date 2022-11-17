@extends('adminlte::page')

@section('title', 'Notas')

@section('content')
<div class="container-fluid p-5">
    <div class="row">
        <div class="col-12">
            <h1>Notas</h1>
            <hr class="bg-dark w100">
        </div>
    </div>
    <div class="row p-2 d-flex mb-3">
        <div class="col m-auto d-flex justify-content-start">
            @can('crear-nota')
            <a href="{{route('select.notes')}}" class="btn btn-primary mb-3"><i class="fas fa-plus"></i></a>
            @endcan
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <table class="table table-striped mt-2 nowrap" style="width:100%;" id="tableNotas">
                <thead style="background-color:#ffff">
                    <th>Id</th>
                    <th>Codigo</th>
                    <th>Ref. Comprobante</th>
                    <th>Cliente</th>
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
        $('#tableNotas').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{route('notes.index')}}",
            dataType: 'json',
            type: "POST",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'notes_serie',
                    name: 'notes_serie'
                },
                {
                    data: 'voucher.voucher_serie',
                    name: 'voucher.voucher_serie'
                },
                {
                    data: 'voucher.client.name',
                    name: 'voucher.client.name'
                },
                {
                    data: 'notes_date',
                    name: 'notes_date' 
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
                }
            ]
        });
    });
</script>

@if (session('success') == 'ok')
<script>
    Swal.fire(
        'Creada!',
        'Nota creada',
        'success'
    )
</script>
@endif

@stop
