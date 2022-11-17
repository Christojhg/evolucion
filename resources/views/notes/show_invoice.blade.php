@extends('adminlte::page')

@section('title', 'Nota')

@section('content')

<div class="container">
<br>
<div class="card">
    <div class="card-header">
        <a href="{{route('notes.index')}}"><button type="button" class="btn btn-primary mb-3"><i class="fas fa-chevron-left"></i> Atras</button></a>
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
                    <small class="float-right">Fecha: {{$note->notes_date}}</small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  De
                  <address>
                      <strong>Empresa {{$note->voucher->company->name}}</strong><br>
                      {{$note->voucher->company->state}}<br>
                      {{$note->voucher->company->street}}, {{$note->voucher->company->city}}<br>
                      Phone: {{$note->voucher->company->phone}}<br>
                      Email: {{$note->voucher->company->email}}
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  Para
                  <address>
                      <strong>Cliente {{$note->voucher->client->name}}</strong><br>
                    Celular: {{$note->voucher->client->phone}}<br>
                    Correo: {{$note->voucher->client->email}} <br>
                    RUC: {{$note->voucher->client->doc_ruc}}
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <h2> Ruc : {{$note->voucher->company->ruc}}    </h2><br>
                <h2>Factura : {{$note->notes_serie}}</h2><br>
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
                    @foreach($note_details as $note_detail)
                            <tr>
                                <td>{{$note_detail->product->cod_prod}}</td>
                                <td>{{$note_detail->product->name}}</td>
                                <td>{{$note_detail->price}}</td>
                                <td>{{$note_detail->quantity}}</td>
                                <td>{{$note->voucher->currency->gloss}} {{$note_detail->price * $note_detail->quantity}}</td>
                                <td hidden>{{$subtotal = $note_detail->price * $note_detail->quantity + $subtotal}}</td>
                            </tr>
                            @endforeach
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
                        <th style="width:50%">Subtotal :</th>
                        <td>{{$note->voucher->currency->gloss}} {{$subtotal}}</td>
                      </tr>
                      <tr>
                        <th style="width:50%">IGV 18% :</th>
                        <td>{{$note->voucher->currency->gloss}} {{$subtotal * 0.18}}</td>
                      </tr>
                      <tr>
                        <th>Total:</th>
                        <td>{{$note->voucher->currency->gloss}} {{$subtotal + $subtotal * 0.18}}</td>
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
                  
                  <form action="{{route('invoice_send')}}"  enctype="multipart/form-data" method="post"  id="form_store">
                    @csrf
                    <input type="text" value="1" name="w" style="display: none">
                    <input type="text" value="{{$note->id}}" name="id" style="display: none">
                    <button type="submit" class="btn btn-success float-right mx-2" style="margin-right: 5px;">
                      Enviar <i class="fab fa-whatsapp"></i>
                    </button>
                  </form>
                  
                  <form action="{{route('invoice_send')}}"  enctype="multipart/form-data" method="post"  id="form_store_correo">
                    @csrf
                    <input type="text" value="{{$note->id}}" name="id" style="display: none">
                    <button type="submit" class="btn btn-primary float-right">
                      Enviar <i class="fas fa-envelope"></i>
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
