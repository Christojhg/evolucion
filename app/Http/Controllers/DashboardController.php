<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Product;
use App\Models\Client;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $users = $this->usersCount();
        $products = $this->productsCount();
        $clients = $this->clientsCount();

        return view('dashboard.home', compact('users', 'products', 'clients'));
    }

    public function usersCount()
    {
        $users_count = User::count();

        return $users_count;
    }

    public function productsCount()
    {
        $products_count = Product::count();

        return $products_count;
    }

    public function clientsCount()
    {
        $clients_count = Client::count();

        return $clients_count;
    }
}
