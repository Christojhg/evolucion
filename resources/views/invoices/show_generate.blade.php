
<!DOCTYPE html>
<html lang="en">
<div class="container">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
</head>

<body>
<br>
<div class="card">
    <div class="card-header">
        <a href="{{route('invoices.index')}}"></a>
        <h3 class="card-title"></h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      @if(session('mensaje')) 
      <div class="alert alert-success alert-dismissible">
        <h5><i class="icon fas fa-check"></i> Alerta!</h5>
          {{session('mensaje')}}
      </div>
      @endif
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            


            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-globe"></i>
                    <small class="float-right">Fecha: {{$invoice->voucher_date}}</small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  De
                  <address>
                    <strong>Empresa {{$invoice->company->name}}</strong><br>
                    {{$invoice->company->state}}<br>
                    {{$invoice->company->street}}, {{$invoice->company->city}}<br>
                    Phone: {{$invoice->company->phone}}<br>
                    Email: {{$invoice->company->email}}
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  Para
                  <address>
                    <strong>Cliente {{$invoice->client->name}}</strong><br>
                    Celular: {{$invoice->client->phone}}<br>
                    Correo: {{$invoice->client->email}} <br>
                    RUC: {{$invoice->client->doc_ruc}}
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <h2> Ruc : {{$invoice->company->ruc}}    </h2><br>
                <h2>Factura : {{$invoice->voucher_serie}}</h2><br>
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
                    @foreach($invoice_details as $invoice_detail)
                            <tr>
                                <td>{{$invoice_detail->product->cod_prod}}</td>
                                <td>{{$invoice_detail->product->name}}</td>
                                <td>{{$invoice_detail->price}}</td>
                                <td>{{$invoice_detail->quantity}}</td>
                                <td>{{$invoice->currency->gloss}} {{$invoice_detail->price * $invoice_detail->quantity}}</td>
                                <td hidden>{{$subtotal = $invoice_detail->price * $invoice_detail->quantity + $subtotal}}</td>
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
                        <td>{{$invoice->currency->gloss}} {{$subtotal}}</td>
                      </tr>
                      <tr>
                        <th style="width:50%">IGV 18% :</th>
                        <td>{{$invoice->currency->gloss}} {{$subtotal * 0.18}}</td>
                      </tr>
                      <tr>
                        <th>Total:</th>
                        <td>{{$invoice->currency->gloss}} {{$subtotal + $subtotal * 0.18}}</td>
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
</body>
  </html>