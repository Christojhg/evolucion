@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<div class="card mb-3">
    <img class="brand-image img-circle elevation-3 img-thumbnail rounded mx-auto d-block" src="{{asset('storage').'/'.$company->photo}}" style="width: 900px; height: 300px;" alt="">
    <div class="card-body row">
            <div class="col-6">
                <div class="form-group">
                    <label for="nameCompany">Nombre</label>
                    <input type="text" name="name" id="nameCompany" class="form-control" value="{{$company->name}}" readonly>
                </div>
                <div class="form-group">
                    <label for="businessCompany">Nombre Negocio</label>
                    <input type="text" name="business_name" id="businessCompany" class="form-control" value="{{$company->business_name}}" readonly>
                </div>
                <div class="form-group">
                    <label for="rucCompany">RUC</label>
                    <input type="text" name="ruc" id="rucCompany" class="form-control" value="{{$company->ruc}}" readonly>
                </div>
                <div class="form-group">
                    <label for="phoneCompany">Telefono</label>
                    <input type="text" name="phone" id="phoneCompany" class="form-control" value="{{$company->phone}}" readonly>
                </div>
                <div class="form-group">
                    <label for="mobileCompany">Móbil</label>
                    <input type="text" name="movile" id="mobileCompany" class="form-control" value="{{$company->movile}}" readonly>
                </div>
                <div class="form-group">
                    <label for="emailCompany">Email</label>
                    <input type="email" name="email" id="emailCompany" class="form-control" value="{{$company->email}}" readonly>
                </div>
                <div class="form-group">
                    <label for="countryCompany">Pais</label>
                    <input type="text" name="country" id="countryCompany" class="form-control" value="{{$company->country}}" readonly>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="stateCompany">Estado</label>
                    <input type="text" name="state" id="stateCompany" class="form-control" value="{{$company->state}}" readonly>
                </div>
                <div class="form-group">
                    <label for="cityCompany">Ciudad</label>
                    <input type="text" name="city" id="cityCompany" class="form-control" value="{{$company->city}}" readonly>
                </div>
                <div class="form-group">
                    <label for="streetCompany">Calle</label>
                    <input type="text" name="street" id="streetCompany" class="form-control" value="{{$company->street}}" readonly>
                </div>
                <div class="form-group">
                    <label for="postalCompany">Código Postal</label>
                    <input type="text" name="postal_code" id="postalCompany" class="form-control" value="{{$company->postal_code}}" readonly>
                </div>
                <div class="form-group">
                    <label for="entryCompany">Rúbro</label>
                    <input type="text" name="entry" id="entryCompany" class="form-control" value="{{$company->entry}}" readonly>
                </div>
                <div class="form-group">
                    <label for="descriptionCompany">Descripción</label>
                    <textarea name="description" class="form-control" id="descriptionCompany" rows="2" readonly>{{$company->description}}</textarea>
                </div>
            </div>
    </div>
</div>
@stop

@section('content')

@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    console.log('Hi!');
</script>
@stop