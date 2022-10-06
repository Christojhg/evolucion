@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')
<div class="container">
    <br>
    <div class="card">
        <div class="card-header">
            <h1>Usuarios</h1>
        </div>
        <div class="card-body">

            @can('crear-usuario')
            <a class="btn btn-success mb-3" href="{{route('users.create')}}">Nuevo Usuario</a>
            @endcan
            <table class="table table-striped mt-2 nowrap" style="width: 100%;" id="tableUsers">
                <thead style="background-color:#6777ef">
                    <th hidden>ID</th>
                    <th style="color:#fff;">Nombre</th>
                    <th style="color:#fff;">Email</th>
                    <th style="color:#fff;">Rol</th>
                    <th style="color:#fff;">Direccion</th>
                    <th style="color:#fff;">Doc. Identidad</th>
                    <th style="color:#fff;">Telefono</th>
                    <th style="color:#fff;">Acciones</th>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td hidden>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            @if(!empty($user->getRoleNames()))
                            @foreach($user->getRoleNames() as $rolNombre)
                            <h5><span class="badge badge-dark">{{ $rolNombre }}</span></h5>
                            @endforeach
                            @endif
                        </td>
                        <td>{{$user->address}}</td>
                        <td>{{$user->doc_id}}</td>
                        <td>{{$user->phone}}</td>
                        <td>
                            <form action="{{route('users.destroy', $user->id)}}" class="formDelete" method="POST">
                                @can('editar-usuario')
                                <a class="btn btn-info" href="{{ route('users.edit',$user->id) }}">Editar</a>
                                @endcan

                                @csrf
                                @method('DELETE')

                                @can('borrar-usuario')
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
        $('#tableUsers').DataTable({
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
        'El usuario ha sido borrado',
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