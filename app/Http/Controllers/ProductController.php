<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-producto|crear-producto|editar-producto|borrar-producto')->only('index');
        $this->middleware('permission:crear-producto', ['only' => ['create','store']]);
        $this->middleware('permission:editar-producto', ['only' => ['edit','update']]);
        $this->middleware('permission:borrar-producto', ['only' => ['destroy']]);
    }
    
    public function index()
    {
        $products = Product::all();


        return view('products.index', compact('products'));
    }

    public function store(ProductRequest $request)
    {

        Product::create($request->all());

        return true;

        //return redirect()->route('products.index')->with('success', 'ok');
    }

    public function edit($id)
    {
        $product = Product::find($id);

        return view('products.modals.editModal', compact('product'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->all());
        
        return redirect()->route('products.index');
    }

    public function destroy($id)
    {
        Product::find($id)->delete();

        return redirect()->route('products.index')->with('delete', 'ok');
    }
}
