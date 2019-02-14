<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Incoming;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function delete($id)
    {
        $count = Incoming::where('customer_id', $id)->count();
        if($count){
            return redirect()->back()->withErrors(['Verisi olan müşteri silinemez.']);
        }else{
            $customer = Customer::find($id);
            if($customer->delete()){
                return redirect()->back()->with('success', 'Müşteri silindi.');
            }else{
                return redirect()->back()->withErrors(['Hata oluştu. Müşteri silme gerçekleşmedi.']);
            }
        }
    }
}
