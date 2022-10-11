@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')
<div class="card mb-3">
    <form action="{{route('companies.update', 1)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="card-body row">
            <div class="col-6">
                <div class="form-group">
                    <label for="nameCompany">Nombre</label>
                    <input type="text" name="name" id="nameCompany" class="form-control" value="{{$company->name}}">
                </div>
                <div class="form-group">
                    <label for="businessCompany">Nombre Negocio</label>
                    <input type="text" name="business_name" id="businessCompany" class="form-control" value="{{$company->business_name}}">
                </div>
                <div class="form-group">
                    <label for="rucCompany">RUC</label>
                    <input type="text" name="ruc" id="rucCompany" class="form-control" value="{{$company->ruc}}" >
                </div>
                <div class="form-group">
                    <label for="phoneCompany">Telefono</label>
                    <input type="text" name="phone" id="phoneCompany" class="form-control" value="{{$company->phone}}" >
                </div>
                <div class="form-group">
                    <label for="mobileCompany">Móbil</label>
                    <input type="text" name="movile" id="mobileCompany" class="form-control" value="{{$company->movile}}">
                </div>
                <div class="form-group">
                    <label for="emailCompany">Email</label>
                    <input type="email" name="email" id="emailCompany" class="form-control" value="{{$company->email}}">
                </div>
                <div class="form-group">
                    <label for="countryCompany">Pais</label>
                    <input type="text" name="country" id="countryCompany" class="form-control" value="{{$company->country}}" >
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="stateCompany">Estado</label>
                    <input type="text" name="state" id="stateCompany" class="form-control" value="{{$company->state}}">
                </div>
                <div class="form-group">
                    <label for="cityCompany">Ciudad</label>
                    <input type="text" name="city" id="cityCompany" class="form-control" value="{{$company->city}}" >
                </div>
                <div class="form-group">
                    <label for="streetCompany">Calle</label>
                    <input type="text" name="street" id="streetCompany" class="form-control" value="{{$company->street}}" >
                </div>
                <div class="form-group">
                    <label for="postalCompany">Código Postal</label>
                    <input type="text" name="postal_code" id="postalCompany" class="form-control" value="{{$company->postal_code}}" >
                </div>
                <div class="form-group">
                    <label for="entryCompany">Rúbro</label>
                    <input type="text" name="entry" id="entryCompany" class="form-control" value="{{$company->entry}}" >
                </div>
                <div class="form-group">
                    <label for="descriptionCompany">Descripción</label>
                    <textarea name="description" class="form-control" id="descriptionCompany" rows="2" >{{$company->description}}</textarea>
                </div>
                <div class="form-group">
                    <label for="photoCompany">Foto</label>
                    <input type="file" name="photo" id="photoCompany" class="form-control" value="{{$company->photo}}" accept="image/png, image/jpeg, image/jpg" />
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success" >Guardar</button>
                </div>
            </div>
        </div>
    </form>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    console.log('Hi!');
</script>
@stop