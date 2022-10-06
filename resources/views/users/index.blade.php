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
            <a class="btn btn-success" href="{{route('users.create')}}">Nuevo Usuario</a>
            @endcan
            <table class="table table-striped mt-2">
                <thead style="background-color:#6777ef">
                    <th style="display: none;">ID</th>
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
    console.log('Hi!');
</script>
@stop