<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function changePassword()
    {
        return view('user.password');
    }

    public function changePass(Request $request)
    {
        if($request->sifre != $request->sifreT){
            return redirect()->back()->withErrors(['Şifreleriniz uyumsuz.']);
        }else{
            $user = User::find(Auth()->user()->id);
            $user['password'] = bcrypt($request->sifre);
            if($user->save()){
                return redirect()->back()->with('success', 'Şifreniz güncellendi.');
            }else{
                return redirect()->back()->withErrors(['Şifreleriniz değiştirilemedi.']);
            }

        }
    }
}
