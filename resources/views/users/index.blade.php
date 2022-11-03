@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')
<div class="container-fluid p-5">
    <div class="row">
        <div class="col-12">
            <h1>Usuarios</h1>
            <hr class="bg-dark w-100">
        </div>
    </div>

    <div class="row p-2 d-flex mb-3">
        <div class="col-1 m-auto">
            @can('crear-usuario')
            <a class="btn btn-primary rounded-circle" href="{{route('users.create')}}"><i class="fas fa-plus"></i></a>
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
        <div class="card-body">

            <table class="table table-striped mt-2 nowrap text-center" style="width: 100%;" id="tableUsers">
                <thead style="background-color:#ffff" class="text-center">
                    <th hidden>ID</th>
                    <th style="">Nombre</th>
                    <th style="">Email</th>
                    <th style="">Rol</th>
                    <th style="">Direccion</th>
                    <th style="">Doc. Identidad</th>
                    <th style="">Telefono</th>
                    <th style="">Acciones</th>
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
                                <a class="btn btn-info rounded-circle" href="{{ route('users.edit',$user->id) }}"><i class="fas fa-pen"></i></a>
                                @endcan

                                @csrf
                                @method('DELETE')

                                @can('borrar-usuario')
                                <button type="submit" class="btn btn-danger rounded-circle"><i class="fas fa-trash"></i></button>
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
        'El usuario ha sido borrado',
        'success'
    )
</script>
@endif

@if (session('success') == 'ok')
<script>
    Swal.fire(
        'Agregado!',
        'El usuario ha sido agregado',
        'success'
    )
</script>
@endif
@stop