<div class="modal fade" id="modalDeletes">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Producto Eliminados</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <table class="table table-striped mt-2 nowrap text-center" style="width:100%;" id="tableDeletes">
                    <thead style="background-color:#ffff" class="text-center">
                        <th hidden>ID</th>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Accion</th>
                    </thead>
                    <tbody>
                        @foreach($eliminados as $eliminado)
                        <tr>
                            <td hidden>{{$eliminado->id}}</td>
                            <td>{{$eliminado->cod_prod}}</td>
                            <td>{{$eliminado->name}}</td>
                            <td>{{$eliminado->description}}</td>
                            <td>{{$eliminado->price}}</td>
                            <td>
                                <form action="{{route('restoreProducts', $eliminado->id)}}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Restaurar</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>

        </div>
    </div>
</div>