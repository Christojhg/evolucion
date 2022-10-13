<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PasswordRequest;

class PasswordController extends Controller
{
    public function index()
    {
        return view('auth.passwords.index');
    }

    public function changePassword(PasswordRequest $request)
    {
        if(!(Hash::check($request->get('actualUserPassword'), Auth::user()->password))){
            return redirect()->back()->with("error", "Tu contraseña actual no coincide");
        }

        if(strcmp($request->get("actualUserPassword"), $request->get("newPassword")) == 0){
            return redirect()->back()->with("error", "La nueva contraseña no puede ser la misma que la anterior");
        }

        $user = Auth::user();
        $user->password = bcrypt($request->get("newPassword"));
        $user->save();

        return redirect()->back()->with("success", "ok");
    }
    
}
