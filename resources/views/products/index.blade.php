@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid p-5">
    <div class="row">
        <div class="col-12">
            <h1>Productos</h1>
            <hr class="bg-dark w-100">
        </div>
    </div>
    <div class="row p-2 d-flex mb-3">
        <div class="col m-auto d-flex justify-content-start">
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalCreate"><i class="fas fa-plus"></i></a>
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
                                <a href="#" data-toggle="modal" data-target="#modalEdit{{$product->id}}" class="btn btn-info"><i class="fas fa-edit"></i></a>
                                @endcan

                                @csrf
                                @method('DELETE')
                                @can('borrar-producto')
                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
            responsive: true,
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'excelHtml5',
                    text: 'Exportar Excel',
                    filename: 'Reporte Clientes',
                    title: '',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5]
                    },
                    className: 'btn-exportar-excel',
                },
                {
                    extend: 'pdfHtml5',
                    text: 'Exportar PDF',
                    filename: 'Reporte Clientes',
                    title: 'Reporte de Clientes',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5]
                    },
                    className: 'btn-exportar-pdf',
                    customize: function(doc) {
                        doc.content[1].margin = [100, 0, 100, 0]
                    }
                },
                {
                    extend: 'print',
                    title: 'Reporte de Clientes',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5]
                    },
                    className: 'btn-exportar-print',
                },
                'pageLength'
            ]
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