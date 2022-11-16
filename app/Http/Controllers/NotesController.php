<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use App\Models\User;
use App\Models\NoteDetail;
use App\Models\Voucher;
use App\Models\VoucherDetail;
use App\Models\Product;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class NotesController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-nota|crear-nota|editar-nota|borrar-nota')->only('index','select');
        $this->middleware('permission:crear-nota', ['only' => ['create','store']]);
        $this->middleware('permission:editar-nota', ['only' => ['edit','update']]);
        $this->middleware('permission:borrar-nota', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $notes = Note::with('voucher_status')->with('voucher.client')->get();

            return DataTables::of($notes)
                ->addColumn('acciones', 'notes.actions')
                ->rawColumns(['acciones'])
                ->make(true);
        }

        return view('notes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function select()
    {
        $vouchers=Voucher::all();
        return view('notes.select',compact('vouchers'));
    }

    
    public function create(Request $request)
    {
        $voucher=Voucher::find($request->id);
        $voucher_details=VoucherDetail::where('id_voucher',$voucher->id)->get();
        $products=Product::all();
        $cantidad=$voucher_details->count();
        $id=$request->id;
        if($voucher->id_voucher_type==1){
            return view('notes.create_v', compact('voucher','products' ,'voucher_details','cantidad','id'));
        }else{
            return view('notes.create_i', compact('voucher','products' ,'voucher_details','cantidad','id'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $voucher=Voucher::find($request->id);
        $notes_count=Note::count();

        $voucher_details=VoucherDetail::where('id_voucher',$voucher->id)->get();

        $ultimaEntrada = $notes_count;

        if (isset($ultimaEntrada)) {
            $numero = $ultimaEntrada;
            $numero++;
            $cantidad_registro = $numberFinal = str_pad($numero, 3, "0", STR_PAD_LEFT);
            $codigo_guia = 'E' . $cantidad_registro;
        } else {
            $codigo_guia = "E001";
            $numberFinal = "001";
        }

        $serie = $codigo_guia;
        
        $note=new Note();
        $note->id_voucher=$voucher->id;
        $note->id_voucher_type=$voucher->id_voucher_type;
        $note->notes_serie= $serie;
        $note->notes_number=$numberFinal;
        $note->notes_date=Carbon::now();
        $note->id_voucher_status=$voucher->id_voucher_status;
        $note->id_currency=$voucher->id_currency;
        $note->id_user=Auth::user()->id;
        $note->save();

        foreach($voucher_details as $voucher_detail){
            $note_detail= new NoteDetail();
            $note_detail->id_notes = $note->id;
            $note_detail->id_prod = $voucher_detail->id_prod;
            $note_detail->quantity = $voucher_detail->quantity;
            $note_detail->price = $voucher_detail->price;
            $note_detail->save();
        }

        
        
        return redirect()->route('notes.index')->with('success', 'ok') ;
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $note=Note::find($id);
        $note_details=NoteDetail::where('id_notes',$note->id)->get();
        $subtotal=0;
        if($note->id_voucher_type==1){
            //Boleta
            return view('notes.show_voucher',compact('note_details','note','subtotal'));
        }else{
            //Factura
            return view('notes.show_invoice',compact('note_details','note','subtotal'));
        }
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
