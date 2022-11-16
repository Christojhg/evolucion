@extends('adminlte::page')

@section('title', 'Notas')

@section('content')
<div class="container">
    <br>
    <div class="card">
        <div class="card-header">
            <h1>Notas</h1>
        </div>
        <div class="card-body">

            <a href="{{route('select.notes')}}" class="btn btn-success mb-3">Nuevo Nota</a>


            <table class="table table-striped mt-2 nowrap" style="width:100%;" id="tableNotas">
                <thead style="background-color:#6777ef">
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
                    data: 'id_voucher',
                    name: 'id_voucher'
                },
                {
                    data: 'id_voucher_type',
                    name: 'id_voucher_type'
                },
                {
                    data: 'notes_serie',
                    name: 'notes_serie'
                },
                {
                    data: 'notes_number',
                    name: 'notes_number' 
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
        'Noya creada',
        'success'
    )
</script>
@endif

@stop
