<div class="modal fade" id="modalEdit{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if ($errors->any())
                <div class="alert alert-dark alert-dismissible fade show" role="alert">
                    <strong>¡Revise los campos!</strong>
                    @foreach ($errors->all() as $error)
                    <span class="badge badge-danger">{{ $error }}</span>
                    @endforeach
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <form action="{{route('products.update', $product->id)}}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="codigoProducto">Código</label>
                        <input type="text" name="cod_prod" class="form-control" id="codigoProducto" value="{{$product->cod_prod}}" placeholder="Código">
                    </div>
                    <div class="form-group">
                        <label for="nameProducto">Nombre</label>
                        <input type="text" name="name" class="form-control" id="nameProducto" value="{{$product->name}}" placeholder="Nombre">
                    </div>
                    <div class="form-group">
                        <label for="descripProducto">Descripción</label>
                        <textarea class="form-control" name="description" id="descripProducto" placeholder="Descripción" style="height: 100px">{{$product->description}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="precioProducto">Precio</label>
                        <input type="number" step="any" name="price" class="form-control" id="precioProducto" value="{{$product->price}}" placeholder="Precio">
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </form>
            </div>
        </div>
    </div>
</div>