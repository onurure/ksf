<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Expense;
use App\PrivatePeriod;
use App\MainClass;
use App\MonthPeriod;
use App\SafeData;
use App\Incoming;

class ParameterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $customers = Customer::all();
        $expenses = Expense::all();
        $privateperiods = PrivatePeriod::all();
        $mainclasses = MainClass::all();
        $monthperiods = MonthPeriod::all();
        return view('parameters', compact('customers', 'expenses', 'privateperiods', 'mainclasses', 'monthperiods'));
    }
    public function save(Request $request)
    {
        if(isset($request->customer)&&$request->customer==1){
            $customer = new Customer();
            $customer->name = $request->customer_name;
            if($customer->save()){
                return redirect()->back()->with('success', 'Müşteri oluşturuldu.');
            }else{
                return redirect()->back()->withErrors(['Bir hata oldu. Daha sonra tekrar deneyin.']);
            }
        }
        if(isset($request->expense)&&$request->expense==1){
            $expense = new Expense();
            $expense->name = $request->expense_name;
            if($expense->save()){
                return redirect()->back()->with('success', 'Gider oluşturuldu.');
            }else{
                return redirect()->back()->withErrors(['Bir hata oldu. Daha sonra tekrar deneyin.']);
            }
        }
        if(isset($request->private_period)&&$request->private_period==1){
            $private_period = new PrivatePeriod();
            $private_period->name = $request->private_period_name;
            if($private_period->save()){
                return redirect()->back()->with('success', 'Özel dönem oluşturuldu.');
            }else{
                return redirect()->back()->withErrors(['Bir hata oldu. Daha sonra tekrar deneyin.']);
            }
        }
        if(isset($request->month_period)&&$request->month_period==1){
            $month_period = new MonthPeriod();
            $month_period->m_name = $request->ay;
            $month_period->y_name = $request->yil;
            if($month_period->save()){
                return redirect()->back()->with('success', 'Ay dönemi oluşturuldu.');
            }else{
                return redirect()->back()->withErrors(['Bir hata oldu. Daha sonra tekrar deneyin.']);
            }
        }
    }
    public function saveTable(Request $request)
    {
        if($request->name=='expense'){
            $parametre = Expense::find($request->pk);
            $parametre->name = $request->value;
        }else if($request->name=='customer'){
            $parametre = Customer::find($request->pk);
            $parametre->name = $request->value;
        }else if($request->name=='mainclass'){
            $parametre = MainClass::find($request->pk);
            $parametre->color = $request->value;
        }else if($request->name=='m_name'){
            $parametre = MonthPeriod::find($request->pk);
            $parametre->m_name = $request->value;
        }else if($request->name=='y_name'){
            $parametre = MonthPeriod::find($request->pk);
            $parametre->y_name = $request->value;
        }
        $parametre->save();
    }

    public function delete($type, $id)
    {
        if($type == 'monthperiod'){
            $count = Incoming::where('month_period_id', $id)->count();
            if($count<1){
                $count = SafeData::where('month_period_id', $id)->count();
            }
            $param = MonthPeriod::find($id);
        }else if($type == 'privateperiod'){
            $count = Incoming::where('private_period_id', $id)->count();
            if($count<1){
                $count = SafeData::where('private_period_id', $id)->count();
            }
            $param = PrivatePeriod::find($id);
        }else if($type == 'expense'){
            $count = SafeData::where('main_class_id',2)->where('sub_class_id', $id)->count();
            if($count<1){
            }
            $param = Expense::find($id);
        }
        if($count){
            return redirect()->back()->withErrors(['Silmek istenen bilginin verisi bulunduğu için silinemez.']);
        }else{
            if($param->delete()){
                return redirect()->back()->with('success', 'Silme işlemi başarılı.');
            }else{
                return redirect()->back()->withErrors(['Hata oluştu. Silme gerçekleşmedi.']);
            }
        }
    }
}
