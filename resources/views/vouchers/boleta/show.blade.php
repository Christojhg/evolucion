@extends('adminlte::page')

@section('title', 'Boletas')

@section('content')

<div class="container">
<br>
<div class="card">
    <div class="card-header">
        <a href="{{route('voucher.index')}}"><button type="button" class="btn btn-primary mb-3">Atras</button></a>
        <h3 class="card-title"></h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      @if(session('mensaje')) 
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-check"></i> Alerta!</h5>
          {{session('mensaje')}}
      </div>
      @endif
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="callout callout-info">
              <h5><i class="fas fa-info"></i> Nota:</h5>
              Esta pagina es solo una vista previa de la Factura. Si desea imprimir haga click en el boton imprimir que esta al final de la vista.
            </div>


            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-globe"></i>
                    <small class="float-right">Fecha: 12/12/2022</small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  De
                  <address>
                    <strong>Empresa</strong><br>
                    Limaj<br>
                    Lima, Lima<br>
                    Phone: 999 999999<br>
                    Email: corre@gmail.com
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  Para
                  <address>
                    <strong>Cliente</strong><br>
                    Celular: 90999999<br>
                    Correo: cliente@gmail.com
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <h2>Boleta : 123-11111</h2><br>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>Codigo Producto</th>
                      <th>Producto</th>
                      <th>Precio</th>
                      <th>Cantidad</th>
                      <th>Subtotal</th>
                      <th style="display: none"></th>
                    </tr>
                    </thead>
                    <tbody>
                        <td>codigo1</td>
                        <td>producto 1</td>
                        <td>10</td>
                        <td>10</td>
                        <td>100</td>
                        <td></td> 
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  <p class="lead">Metodos de Pago:</p>
                  <img src="{{ asset('img/visa.png') }}" alt="Visa">
                  <img src="{{ asset('img/mastercard.png') }}" alt="Mastercard">
                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                    Aceptamos Cualquier metodo de pago
                  </p>
                </div>
                <!-- /.col -->
                <div class="col-6">
                  <p class="lead"></p>

                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%">Subtotal:</th>
                        <td>100</td>
                      </tr>
                      <tr>
                        <th>Total:</th>
                        <td>100</td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <a href="#" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Imprimir</a>
                  
                  <form action="#"  enctype="multipart/form-data" method="post"  id="form_store">
                    @csrf
                    <button type="submit" class="btn btn-primary float-right" style="margin-right: 5px;">
                      Enviar Por WhatsApp
                    </button>
                  </form>
                  
                  <form action="#"  enctype="multipart/form-data" method="post"  id="form_store">
                    @csrf
                    <button type="submit" class="btn btn-success float-right">
                      Enviar a correo
                    </button></a>
                  </form>
                  
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.card-body -->
  </div></div>
@endsection
