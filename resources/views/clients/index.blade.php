@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')
<div class="container">
    <br>
    <div class="card">
        <div class="card-header">
            <h1>Clientes</h1>
        </div>
        <div class="card-body">

            @can('crear-cliente')
            <a class="btn btn-success mb-3" href="{{route('clients.create')}}">Nuevo Cliente</a>
            @endcan

            <table class="table table-striped mt-2 nowrap" style="width: 100%;" id="tableClients">
                <thead style="background-color:#6777ef">
                    <th hidden>ID</th>
                    <th style="color:#fff;">Nombre</th>
                    <th style="color:#fff;">Email</th>
                    <th style="color:#fff;">Direccion</th>
                    <th style="color:#fff;">Doc</th>
                    <th style="color:#fff;">Telefono</th>
                    <th style="color:#fff;">Acciones</th>
                </thead>
                <tbody>
                    @foreach($clients as $client)
                    <tr>
                        <td hidden>{{$client->id}}</td>
                        <td>{{$client->name}}</td>
                        <td>{{$client->email}}</td>
                        <td>{{$client->address}}</td>
                        <td>{{$client->doc_id}}</td>
                        <td>{{$client->phone}}</td>                        
                        <td>
                            <form action="{{route('clients.destroy', $client->id)}}" class="formDelete" method="POST">
                                @can('editar-cliente')
                                <a class="btn btn-info" href="{{ route('clients.edit',$client->id) }}">Editar</a>
                                @endcan

                                @csrf
                                @method('DELETE')

                                @can('borrar-cliente')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                @endcan
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
    $(document).ready( function () {
        $('#tableClients').DataTable({
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json"
            },
            responsive: true
        });
    } );
</script>

@if (session('delete') == 'ok')
<script>
    Swal.fire(
        'Borrado!',
        'El cliente ha sido borrado',
        'success'
    )
</script>
@endif
<script>
    $('.formDelete').submit(function(e) {
        e.preventDefault();

        Swal.fire({
            title: 'Está seguro de eliminar?',
            icon: 'warning',
            text: 'Se borrara permanentemente',
            showCancelButton: true,
            confirmButtonColor: '#308d56',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, borrar',
            cancelButtonText: 'No',
        }).then((result) => {
            if (result.value) {
                this.submit();

            }
        })
    })
</script>
@stop