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

            <a href="#" class="btn btn-success mb-3" data-toggle="modal" data-target="#modalCreate">Nuevo Producto</a>
            
            <table class="table table-striped mt-2 nowrap" style="width:100%;" id="tableProducts">
                <thead style="background-color:#6777ef">
                    <th hidden>ID</th>
                    <th style="color:#fff;">Código</th>
                    <th style="color:#fff;">Nombre</th>
                    <th style="color:#fff;">Descripción</th>
                    <th style="color:#fff;">Precio</th>
                    <th style="color:#fff;">Acciones</th>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td hidden>{{$product->id}}</td>
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

        </div>
    </div>
</div>

@include('products.modals.createModal')
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

<script>
    $(document).ready( function () {
        $('#tableProducts').DataTable({
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json"
            },
            responsive: true
        });
    } );
</script>


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

@stop