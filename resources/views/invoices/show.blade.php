@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    {{$invoice->company->ruc}}
                    <br>
                    {{$invoice->voucher_date}}
                    <br>
                    {{$invoice->voucher_serie}}
                    <br>
                    <br>
                    <address>
                        {{$invoice->company->name}}
                        <br>
                        {{$invoice->company->phone}}
                        <br>
                        {{$invoice->company->email}}
                    </address>
                    <br>
                    <br>
                    <br>
                    <address>
                        {{$invoice->client->name}}
                        <br>
                        {{$invoice->client->phone}}
                        <br>
                        {{$invoice->client->email}}
                    </address>
                    <br>
                    <table class="table table-light">
                        <thead class="thead-light">
                            <tr>
                                <th>Codigo Producto</th>
                                <th>Producto</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Subtotal</th>
                                <th hidden></th>
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
                        <tbody>
                            <tr align="center">
                                <td></td>
                                <td></td>
                                <td>Subtotal</td>
                                <td colspan="2">{{$invoice->currency->gloss}} {{$subtotal}}</td>
                            </tr>
                            <tr align="center">
                                <td></td>
                                <td></td>
                                <td>IGV</td>
                                <td colspan="2">{{$invoice->currency->gloss}} {{$subtotal * 0.18}}</td>
                            </tr>
                            <tr align="center">
                                <td></td>
                                <td></td>
                                <td>Total</td>
                                <td colspan="2">{{$invoice->currency->gloss}} {{$subtotal + $subtotal * 0.18}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')

@stop

@section('js')

@stop