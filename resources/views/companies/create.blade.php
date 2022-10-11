@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')
<div class="container">
    <br>
    <div class="card mb-3">
        <div class="card-header">
            <h1>Datos de empresa</h1>
        </div>
        <form action="{{route('companies.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body row">
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
                <div class="col-6">
                    <div class="form-group">
                        <label for="nameCompany">Nombre</label>
                        <input type="text" name="name" id="nameCompany" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label for="businessCompany">Nombre Negocio</label>
                        <input type="text" name="business_name" id="businessCompany" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label for="rucCompany">RUC</label>
                        <input type="text" name="ruc" id="rucCompany" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label for="phoneCompany">Telefono</label>
                        <input type="text" name="phone" id="phoneCompany" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label for="mobileCompany">Móbil</label>
                        <input type="text" name="movile" id="mobileCompany" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label for="emailCompany">Email</label>
                        <input type="email" name="email" id="emailCompany" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label for="descriptionCompany">Descripción</label>
                        <textarea name="description" class="form-control" id="descriptionCompany" rows="2"></textarea>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="stateCompany">Estado</label>
                        <input type="text" name="state" id="stateCompany" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label for="cityCompany">Ciudad</label>
                        <input type="text" name="city" id="cityCompany" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label for="streetCompany">Calle</label>
                        <input type="text" name="street" id="streetCompany" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label for="postalCompany">Código Postal</label>
                        <input type="text" name="postal_code" id="postalCompany" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label for="entryCompany">Rúbro</label>
                        <input type="text" name="entry" id="entryCompany" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label for="countryCompany">Pais</label>
                        <input type="text" name="country" id="countryCompany" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label for="photoCompany">Foto</label>
                        <input type="file" name="photo" id="photoCompany" class="form-control" value="" accept="image/png, image/jpeg, image/jpg" />
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
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