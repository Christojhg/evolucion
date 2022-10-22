<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Client;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        //Tarjetas
        $users = $this->usersCount();
        $products = $this->productsCount();
        $clients = $this->clientsCount();
        //Graficos ChartJS
        $dataBar = $this->barSales();
        $dataPie = $this->pieProducts();
        $dataBar2 = $this->salesClient();

        return view('dashboard.index', compact('dataBar', 'dataPie', 'dataBar2', 'users', 'products', 'clients'));
    }

    public function salesClient()
    {
        $clientsSales = DB::select("CALL sp_salesclients");

        $dataBar2 = [];

        foreach ($clientsSales as $sale) {
            $dataBar2['label'][] = $sale->name;
            $dataBar2['data'][] = $sale->ventas;
        }

        $dataBar2['dataBar2'] = json_encode($dataBar2);

        return $dataBar2;
    }

    public function pieProducts()
    {
        $products = DB::select("CALL sp_masvendido");

        $dataPie = [];

        foreach ($products as $product) {
            $dataPie['label'][] = $product->name;
            $dataPie['data'][] = $product->cantidad;
        }

        $dataPie['dataPie'] = json_encode($dataPie);



        return $dataPie;
    }

    public function barSales()
    {
        $ventas = DB::select("CALL sp_reporte");

        $dataBar = [];

        foreach ($ventas as $venta) {
            $dataBar['label'][] = $venta->day_v;
            $dataBar['data'][] = $venta->sum_days;
        }

        $dataBar['dataBar'] = json_encode($dataBar);

        return $dataBar;
    }

    public static function usersCount()
    {
        $users_count = User::count();

        return $users_count;
    }

    public static function productsCount()
    {
        $products_count = Product::count();

        return $products_count;
    }

    public static function clientsCount()
    {
        $clients_count = Client::count();

        return $clients_count;
    }
}
