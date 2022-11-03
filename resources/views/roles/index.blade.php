@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')
<div class="container-fluid p-5">
    <div class="row">
        <div class="col-12">
            <h1 class="h1">Roles</h1>
            <hr class="bg-dark w-100">
        </div>
    </div>
    <div class="row p-2 d-flex mb-3">
        <div class="col-1 m-auto">
            @can('crear-rol')
                <a class="btn btn-primary rounded-circle" href="{{ route('roles.create') }}">
                    <i class="fas fa-plus"></i>
                </a>
            @endcan
        </div>
        <div class="col-8 d-flex p-2 m-auto">
            <input type="hidden" class="form-control mx-2 w-50">
        </div>
        <div class="col-2 m-auto">
            <button class="btn btn-success mx-2"><i class="far fa-file-excel"></i></button>
            <button class="btn btn-danger mx-2"><i class="far fa-file-pdf"></i></button>
            <button class="btn btn-primary rounded-circle mx-2"><i class="fas fa-print"></i></button>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <table class="table table-striped mt-2 nowrap" style="width: 100%;" id="tableRoles">
                <thead style="background-color:#ffff">
                    <th style="">Rol</th>
                    <th style="">Acciones</th>
                </thead>
                <tbody>
                    @foreach($roles as $role)
                    <tr>
                        <td>{{$role->name}}</td>
                        <td>
                            <form action="{{route('roles.destroy', $role->id)}}" class="formDelete" method="POST">
                                @can('editar-rol')
                                <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}"><i class="fas fa-pen"></i></a>
                                @endcan

                                @csrf
                                @method('DELETE')
                                @can('borrar-rol')
                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
        $('#tableRoles').DataTable({
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json"
            },
            responsive: true
        });
    } );
</script>

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

@if (session('delete') == 'ok')
<script>
    Swal.fire(
        'Borrado!',
        'El rol ha sido borrado',
        'success'
    )
</script>
@endif


@if (session('success') == 'ok')
<script>
    Swal.fire(
        'Agregado!',
        'El rol ha sido agregado',
        'success'
    )
</script>
@endif
@stop