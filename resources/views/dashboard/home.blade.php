@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')
<section class="section">
    <br>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 col-xl-4">

                                <div class="card bg-c-blue order-card">
                                    <div class="card-block">
                                        <h5>Usuarios</h5>

                                        <h2 class="text-right"><i class="fa fa-users f-left"></i><span>{{$users}}</span></h2>
                                        <p class="m-b-0 text-right"><a href="" class="text-white">Ver más</a></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-xl-4">
                                <div class="card bg-c-green order-card">
                                    <div class="card-block">
                                        <h5>Productos</h5>

                                        <h2 class="text-right"><i class="fa fa-user-lock f-left"></i><span>{{$products}}</span></h2>
                                        <p class="m-b-0 text-right"><a href="" class="text-white">Ver más</a></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-xl-4">
                                <div class="card bg-c-pink order-card">
                                    <div class="card-block">
                                        <h5>Clientes</h5>

                                        <h2 class="text-right"><i class="fa fa-blog f-left"></i><span>{{$clients}}</span></h2>
                                        <p class="m-b-0 text-right"><a href="" class="text-white">Ver más</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop

@section('css')
<link rel="stylesheet" href="{{asset('css/admin_custom.css')}}">

@stop

@section('js')
<script>
    console.log('Hi!');
</script>
@stop