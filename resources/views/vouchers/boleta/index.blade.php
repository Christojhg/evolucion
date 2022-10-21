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

            <a href="{{route('voucher.create')}}" class="btn btn-success mb-3">Nuevo Boleta</a>
            
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
                    <tr>
                        <td hidden>Id</td>
                        <td>Cod001</td>
                        <td>Cliente 1</td>
                        <td>Estado 1</td>
                        <td>21/10/2022</td>
                        <td>
                            <a href="{{route('voucher.show',1)}}"><button type="submit" class="btn btn-warning">Ver</button></a>
                        </td>
                    </tr>
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

@stop
