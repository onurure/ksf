<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Expense;
use App\User;
use App\SafeAccount;
use App\Firm;

class AjaxController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function mainClass(Request $request)
    {
        if($request->mainclassid==1){
            $datas = Customer::all()->pluck('name', 'id');
        }else if($request->mainclassid==2){
            $datas = Expense::all()->pluck('name', 'id');
        }else if($request->mainclassid==3||$request->mainclassid==4||$request->mainclassid==5){
            $data = User::where('status',1)->where('is_admin',0)->select('id', 'name', 'lastname')->get();
            foreach($data as $d){
                $name = $d->name.' '.$d->lastname;
                $datas[$d->id] = $name;
            }
        }else if($request->mainclassid==6){
            $data = Firm::find($request->firmid)->users()->select('users.id', 'name', 'lastname')->get();
            foreach($data as $d){
                $name = $d->name.' '.$d->lastname;
                $datas[$d->id] = $name;
            }
        }else if($request->mainclassid==7){
            $datas = SafeAccount::where('firm_id', $request->firmid)->pluck('name', 'id');
        }else{
            $datas = '';
        }
        return response()->json($datas);
    }

    public function mainClasses(Request $request)
    {
        $mainclassid = $request->mainclassids;
        if(in_array(1, $mainclassid)){
            $datas[1] = Customer::all()->pluck('name', 'id');
        }
        if(in_array(2, $mainclassid)){
            $datas[2] = Expense::all()->pluck('name', 'id');
        }
        if(in_array(3, $mainclassid) || in_array(4, $mainclassid) || in_array(5, $mainclassid)){
            $data = User::where('status',1)->where('is_admin',0)->select('id', 'name', 'lastname')->get();
            foreach($data as $d){
                $name = $d->name.' '.$d->lastname;
                $datas[3][$d->id] = $name;
            }
        }
        if(in_array(6, $mainclassid)){
            $data = Firm::find($request->firmid)->users()->select('users.id', 'name', 'lastname')->get();
            foreach($data as $d){
                $name = $d->name.' '.$d->lastname;
                $datas[6][$d->id] = $name;
            }
        }
        if(in_array(7, $mainclassid)){
            $datas[7] = SafeAccount::where('firm_id', $firmid)->pluck('name', 'id');
        }
        return response()->json($datas);
    }
}
