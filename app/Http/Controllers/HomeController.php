<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
    public function notActive()
    {
        Auth::logout();
        return redirect('/')->withErrors(['Sisteme giriş izniniz yok. Lütfen yöneticiniz ile görüşün.']);
    }
    public function dashboard()
    {
        return view('dashboard.dashboard');
    }
}
