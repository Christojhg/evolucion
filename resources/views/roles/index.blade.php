@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')
<div class="container">
    <br>
    <div class="card">
        <div class="card-header">
            <h1>Roles</h1>
        </div>
        <div class="card-body">

            @can('crear-rol')
            <a class="btn btn-success" href="{{ route('roles.create') }}">Nuevo Rol</a>
            @endcan

            <table class="table table-striped mt-2">
                <thead style="background-color:#6777ef">
                    <th style="color:#fff;">Rol</th>
                    <th style="color:#fff;">Acciones</th>
                </thead>
                <tbody>
                    @foreach($roles as $role)
                    <tr>
                        <td>{{$role->name}}</td>
                        <td>
                            <form action="{{route('roles.destroy', $role->id)}}" class="formDelete" method="POST">
                                @can('editar-rol')
                                <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Editar</a>
                                @endcan

                                @csrf
                                @method('DELETE')
                                @can('borrar-rol')
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

@if (session('delete') == 'ok')
<script>
    Swal.fire(
        'Borrado!',
        'El rol ha sido borrado',
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