<div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('products.store')}}" id="formCreate" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="codigoProducto">Código</label>
                        <input type="text" name="cod_prod" class="form-control" value="{{old('cod_prod')}}" id="codigoProducto" placeholder="Código">
                        @if($errors->has('cod_prod'))
                        <span class="text-danger">{{$errors->first('cod_prod')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="nameProducto">Nombre</label>
                        <input type="text" name="name" class="form-control" value="{{old('name')}}" id="nameProducto" placeholder="Nombre">
                        @if($errors->has('name'))
                        <span class="text-danger">{{$errors->first('name')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="descripProducto">Descripción</label>
                        <textarea class="form-control" name="description" id="descripProducto" placeholder="Descripción" style="height: 100px">{{old('description')}}</textarea>
                        @if($errors->has('description'))
                        <span class="text-danger">{{$errors->first('description')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="precioProducto">Precio</label>
                        <input type="number" step="any" name="price" class="form-control" value="{{old('price')}}" id="precioProducto" placeholder="Precio">
                        @if($errors->has('price'))
                        <span class="text-danger">{{$errors->first('price')}}</span>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-success" id="ajaxSubmit">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>