@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid p-5">
    <div class="row">
        <div class="col-12">
            <h1 class="h1">Productos</h1>
            <hr class="bg-dark w-100">
        </div>
    </div>
    <div class="row p-2 d-flex mb-3">
        <div class="col-1 m-auto">
            <a href="#" class="btn btn-primary rounded-circle" data-toggle="modal" data-target="#modalCreate">
                <i class="fas fa-plus"></i>
            </a>
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

    {{-- tabla de contenido --}}
    <div class="row">
        <div class="col-12">
            <table class="table table-striped mt-2 nowrap text-center" style="width:100%;" id="tableProducts">
                <thead style="background-color:#ffff" class="text-center">
                    <th hidden>ID</th>
                    <th style="">Código</th>
                    <th style="">Nombre</th>
                    <th style="">Descripción</th>
                    <th style="">Precio</th>
                    <th style="">Acciones</th>
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
                                <a href="#" data-toggle="modal" data-target="#modalEdit{{$product->id}}" class="btn btn-info rounded-circle"><i class="fas fa-pen"></i></a>
                                @endcan

                                @csrf
                                @method('DELETE')
                                @can('borrar-producto')
                                <button type="submit" class="btn btn-danger rounded-circle"><i class="fas fa-trash"></i></button>
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