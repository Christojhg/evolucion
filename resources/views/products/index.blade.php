@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <br>
    <div class="card">
        <div class="card-header">
            <h1>Productos</h1>
        </div>
        <div class="card-body">

            <a href="#" class="btn btn-success" data-toggle="modal" data-target="#modalCreate">Nuevo Producto</a>

            <table class="table table-striped mt-2">
                <thead style="background-color:#6777ef">
                    <th style="display: none;">ID</th>
                    <th style="color:#fff;">Código</th>
                    <th style="color:#fff;">Nombre</th>
                    <th style="color:#fff;">Descripción</th>
                    <th style="color:#fff;">Precio</th>
                    <th style="color:#fff;">Acciones</th>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td>{{$product->cod_prod}}</td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->description}}</td>
                        <td>{{$product->price}}</td>
                        <td>
                            <form action="{{route('products.destroy', $product->id)}}" class="formDelete" method="POST">
                                @can('editar-producto')
                                <a href="#" data-toggle="modal" data-target="#modalEdit{{$product->id}}" class="btn btn-info">Editar</a>
                                @endcan

                                @csrf
                                @method('DELETE')
                                @can('borrar-producto')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                @endcan
                            </form>
                        </td>
                    </tr>
                    @include('products.modals.editModal')
                    @endforeach()
                </tbody>
            </table>

            {!! $products->links() !!}

        </div>
    </div>
</div>

@include('products.modals.createModal')
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@if(!$errors->isEmpty())
    @if($errors->has('post'))
        <script>
            $(function() {
                $('#modalCreate').modal('show');
            });
        </script>
    @else
        <script>
            $(function() {
                $('#modalEdit{{$product->id}}').modal('show');
            });
        </script>
    @endif
@endif

@if (session('delete') == 'ok')
<script>
    Swal.fire(
        'Borrado!',
        'El producto ha sido borrado',
        'success'
    )
</script>
@endif
@if (session('success') == 'ok')
<script>
    Swal.fire(
        'Agregado!',
        'El producto ha sido agregado',
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