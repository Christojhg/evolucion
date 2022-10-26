<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Company;
use App\Models\Currency;
use App\Models\Product;
use App\Models\User;
use App\Models\Voucher;
use App\Models\VoucherDetail;
use App\Models\VoucherStatus;
use App\Models\VoucherType;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\VoucherRequest;



class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vouchers = Voucher::where('id_voucher_type','1')->get()->all();
        return view('vouchers.boleta.index',compact('vouchers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::all();
        $products = Product::all();
        $currencies = Currency::pluck('name','id')->toArray();
        return view('vouchers.boleta.create',compact('clients','products','currencies'));
    }

    public function precio_ajax_b(Request $request)
    {
        $articulo = $request->product;
        $producto = Product::where('name', $articulo )->first();
        return $producto->price;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VoucherRequest $request)
    {
        //tipo_boleta
        $tipo = VoucherType::where('name', 'Boleta')->get('id')->first();

        //serie y numero
        $ultimaEntrada = Voucher::where('id_voucher_type','1');

        if (isset($ultimaEntrada)) {
            $numero = $ultimaEntrada->count();
            $numero++;
            $cantidad_registro = $numberFinal = str_pad($numero, 3, "0", STR_PAD_LEFT);
            $codigo_guia = 'B' . $cantidad_registro;
        } else {
            $codigo_guia = "B001";
            $numberFinal = "001";
        }

        $serie = $codigo_guia;

        //fecha 
        $actualDate = Carbon::now()->toDateTimeString();
        //estado
        $status = VoucherStatus::where('name','No Enviado')->get('id')->first();
        //moneda
        $currency = $request->get('currency_voucher');
        //compañia
        $company =  Company::first()->get('id');
        //usuario
        $user = Auth::id();
        //cliente
        $clientName = $request->client_name;
        $name = strstr($clientName, ' | ', true);
        $client_find = Client::where('id', $name)->first();

        //voucher
        $voucher = new Voucher();
        $voucher->id_voucher_type = $tipo->id;
        $voucher->voucher_serie = $serie;
        $voucher->voucher_number =  $numberFinal;
        $voucher->voucher_date = $actualDate;
        $voucher->id_voucher_status = $status->id;
        $voucher->id_currency = $currency;
        $voucher->id_companie = 1;
        $voucher->id_user = $user;
        $voucher->id_client = $client_find->id;

        //contador de registro y detalles
        $cantidad = count($request->product);
        if($cantidad != 0)
        {
            $voucher->save();
            for($i=0 ;$i < $cantidad; $i++ ){
                $product_name = Product::where('name', $request->product[$i])->first();

                $voucher_detail = new VoucherDetail();

                $voucher_detail->id_voucher = $voucher->id;
                $voucher_detail->id_prod = $product_name->id;
                $voucher_detail->quantity = $request->cantidad[$i];
                $voucher_detail->price = $request->precio[$i];
                $voucher_detail->save();
            }
        }

        return redirect()->route('voucher.index');



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $voucher = Voucher::find($id);
        $voucher_details = VoucherDetail::where('id_voucher', $id)->get();
        $subtotal = 0;
        return view('vouchers.boleta.show', compact('voucher','voucher_details','subtotal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
