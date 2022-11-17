<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
</head>

<body>
    <div class="container">
        <br>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
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
                                            <small class="float-right">Fecha: {{$voucher->voucher_date}}</small>
                                        </h4>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- info row -->
                                <div class="row invoice-info">
                                    <div class="col-sm-4 invoice-col">
                                        De
                                        <address>
                                            <strong>Empresa {{$voucher->company->name}}</strong><br>
                                            {{$voucher->company->state}}<br>
                                            {{$voucher->company->street}}, {{$voucher->company->city}}<br>
                                            Phone: {{$voucher->company->phone}}<br>
                                            Email: {{$voucher->company->email}}
                                        </address>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4 invoice-col">
                                        Para
                                        <address>
                                            <strong>Cliente {{$voucher->client->name}}</strong><br>
                                            Celular: {{$voucher->client->phone}}<br>
                                            Correo: {{$voucher->client->email}} <br>
                                            RUC: {{$voucher->client->doc_ruc}}
                                        </address>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4 invoice-col">
                                        <h2> Ruc : {{$voucher->company->ruc}} </h2><br>
                                        <h2>Factura : {{$voucher->voucher_serie}}</h2><br>
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
                                                @foreach($voucher_details as $voucher_detail)
                                                <tr>
                                                    <td>{{$voucher_detail->product->cod_prod}}</td>
                                                    <td>{{$voucher_detail->product->name}}</td>
                                                    <td>{{$voucher_detail->price}}</td>
                                                    <td>{{$voucher_detail->quantity}}</td>
                                                    <td>{{$voucher->currency->gloss}} {{$voucher_detail->price * $voucher_detail->quantity}}</td>
                                                    <td hidden>{{$subtotal = $voucher_detail->price * $voucher_detail->quantity + $subtotal}}</td>
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
                                                    <td>{{$voucher->currency->gloss}} {{$subtotal}}</td>
                                                </tr>
                                            
                                                <tr>
                                                    <th>Total:</th>
                                                    <td>{{$voucher->currency->gloss}} {{$subtotal }}</td>
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
        </div>
    </div>
</body>

</html>