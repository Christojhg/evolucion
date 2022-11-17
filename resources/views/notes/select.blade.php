@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')
<div class="container-fluid p-5">
    <div class="row">
        <div class="col-12">
            <h1>Seleccionar Comprobante</h1>
            <hr class="bg-dark w100">
        </div>
    </div>
    <div class="row p-2 d-flex mb-3">
        <div class="col m-auto d-flex justify-content-start">
            <a class="btn btn-primary" href="{{route('notes.index')}}"><i class="fas fa-chevron-left"></i> Atras</a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <table class="table table-striped mt-2 nowrap" style="width: 100%;" id="tableClients">
                <thead style="background-color:#ffff" class="text-center">
                    <th hidden>ID</th>
                    <th style="">Codigo</th>
                    <th style="">Cliente</th>
                    <th style="">Fecha</th>
                    <th style="">Estado</th>
                    <th style="">Acciones</th>
                </thead>
                <tbody>
                    @foreach($vouchers as $voucher)
                    <tr>
                        <td hidden>{{$voucher->id}}</td>
                        <td>{{$voucher->voucher_serie}}</td>
                        <td>{{$voucher->client->name}}</td>
                        <td>{{$voucher->voucher_date}}</td>
                        <td>{{$voucher->voucher_status->name}}</td>
                        <td>
                            <form action="{{route('select.notes_create')}}" class="formCreate text-center" method="POST">
                                @csrf
                                <input type="text" name="id" value="{{$voucher->id}}" style="display: none">
                                <button type="submit" class="btn btn-success"><i class="fas fa-clipboard-check"></i></button>
                            </form>
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
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    $(document).ready(function() {
        $('#tableClients').DataTable({
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json"
            },
            responsive: true,
            columnDefs: [{
                targets: 4,
                render: function(data) {
                    if (data == 'No Enviado') {
                        return `<span class="badge badge-dark">${data}</span>`;
                    } else {
                        return `<span class="badge badge-success">${data}</span>`;
                    }
                }
            }]
        });
    });
</script>

@stop