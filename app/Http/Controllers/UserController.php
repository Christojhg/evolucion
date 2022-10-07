<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-usuario|crear-usuario|editar-usuario|borrar-usuario')->only('index');
        $this->middleware('permission:crear-usuario', ['only' => ['create','store']]);
        $this->middleware('permission:editar-usuario', ['only' => ['edit','update']]);
        $this->middleware('permission:borrar-usuario', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(5);

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();

        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $campos = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'address' => 'required',
            'phone' => 'required|numeric',
            'doc_id' => 'required|numeric',
            'roles' => 'required'
        ];

        $mensaje = [
            'required' => 'El :attribute es requerido',
            'name.required' => 'El nombre es requerido',
            'email.required' => 'El email es requerido',
            'password.required' => 'La contraseña es requerida',
            'password.same' => 'Contraseñas no concuerdan',
            'address.required' => 'La direccion es requerida',
            'doc_id.required' => 'El documento es requerido',
            'doc_id.numeric' => 'El documento debe ser un numero',
            'phone.required' => 'El telefono es requerido',
            'phone.numeric' => 'El telefono debe ser un numero'
        ];

        $this->validate($request, $campos, $mensaje);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);

        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')->with('success', 'ok');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('users.edit', compact('user', 'roles', 'userRole'));
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
        $campos = [
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required|numeric',
            'doc_id' => 'required|numeric',
            'roles' => 'required'
        ];

        $mensaje = [
            'required' => 'El :attribute es requerido',
            'name.required' => 'El nombre es requerido',
            'address.required' => 'La direccion es requerida',
            'doc_id.required' => 'El documento es requerido',
            'doc_id.numeric' => 'El documento debe ser un numero',
            'phone.required' => 'El telefono es requerido',
            'phone.numeric' => 'El telefono debe ser un numero'
        ];

        $this->validate($request, $campos, $mensaje);

        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        } else{
            $input = Arr::except($input, array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();

        return redirect()->route('users.index')->with('delete', 'ok');
    }
}
