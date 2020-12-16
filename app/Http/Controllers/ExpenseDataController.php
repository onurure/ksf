<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ExpenseData;
use App\Firm;
use App\PrivatePeriod;
use App\MonthPeriod;
use App\Expense;

class ExpenseDataController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $firms = Firm::all();
        $privateperiods = PrivatePeriod::all();
        $monthperiods = MonthPeriod::all();
        $expenses = Expense::all();
        if(isset($request->firm)){
            $firmselect = Firm::find($request->firm);
            $expensedatas = $firmselect->expensedatas()->orderBy('data_date');
            if($request->aramusteri!=''){
                $expensedatas = $expensedatas->where('customer_id', $request->aramusteri);
            }else if(isset($request->selectcustomer)){
                $expensedatas = $expensedatas->whereIn('customer_id', $request->selectcustomer);
            }
            if($request->aratarih!=''){
                $aratarih = date('Y-m-d', strtotime(str_replace('/','-',$request->aratarih)));
                $expensedatas = $expensedatas->where('data_date', $aratarih);
            }
            if($request->aratip!=''){
                $expensedatas = $expensedatas->where('type', $request->aratip);
            }
            if($request->aramusteri!=''){
                $expensedatas = $expensedatas->where('customer_id', $request->aramusteri);
            }
            if($request->araproje!=''){
                $expensedatas = $expensedatas->where('project', 'like', '%'.$request->araproje.'%');
            }
            if($request->aradetay!=''){
                $expensedatas = $expensedatas->where('detail', 'like', '%'.$request->aradetay.'%');
            }
            if($request->arafaturano!=''){
                $expensedatas = $expensedatas->where('billno', 'like', '%'.$request->arafaturano.'%');
            }
            if($request->arakasa!=''){
                $expensedatas = $expensedatas->where('safe_id', $request->arakasa);
            }
            if($request->aramatrah!=''){
                $expensedatas = $expensedatas->where('netprice',  'like', '%'.$request->aramatrah.'%');
            }
            if($request->arakdv!=''){
                $expensedatas = $expensedatas->where('tax', $request->arakdv);
            }
            // if($request->arakdvtutar!=''){
            //     $incomings = $incomings->where('sub_class_id', $request->arakdvtutar);
            // }
            if($request->araresmitutar!=''){
                $expensedatas = $expensedatas->where('officialprice', 'like', '%'. $request->araresmitutar.'%');
            }
            if($request->aragrtutar!=''){
                $expensedatas = $expensedatas->where('nonofficialprice', 'like', '%'. $request->aragrtutar.'%');
            }
            if($request->aratoplam!=''){
                $expensedatas = $expensedatas->where('totalprice', 'like', '%'. $request->aratoplam.'%');
            }
            if($request->aramonth!=''){
                $expensedatas = $expensedatas->where('month_period_id', $request->aramonth);
            }
            if($request->araozel!=''){
                $expensedatas = $expensedatas->where('private_period_id', $request->araozel);
            }
            $expensedatas = $expensedatas->get();
        }else{
            $firmselect = '';
            $incomings = '';
        }
        return view('expense.index', compact('firms', 'firmselect', 'monthperiods', 'privateperiods', 'expensedatas', 'expenses'));
    }
    public function arama(Request $request)
    {
        $firms = Firm::all();
        $privateperiods = PrivatePeriod::all();
        $monthperiods = MonthPeriod::all();
        $expenses = Expense::all();
        if(isset($request->firm)){
            $firmselect = Firm::find($request->firm);
            $expensedatas = $firmselect->expensedatas()->orderBy('data_date');
            if($request->aramusteri!=''){
                $expensedatas = $expensedatas->where('customer_id', $request->aramusteri);
            }else if(isset($request->selectcustomer)){
                $expensedatas = $expensedatas->whereIn('customer_id', $request->selectcustomer);
            }
            if($request->aratarih!=''){
                $aratarih = date('Y-m-d', strtotime(str_replace('/','-',$request->aratarih)));
                $expensedatas = $expensedatas->where('data_date', $aratarih);
            }
            if($request->aratip!=''){
                $expensedatas = $expensedatas->where('type', $request->aratip);
            }
            if($request->aramusteri!=''){
                $expensedatas = $expensedatas->where('customer_id', $request->aramusteri);
            }
            if($request->araproje!=''){
                $expensedatas = $expensedatas->where('project', 'like', '%'.$request->araproje.'%');
            }
            if($request->aradetay!=''){
                $expensedatas = $expensedatas->where('detail', 'like', '%'.$request->aradetay.'%');
            }
            if($request->arafaturano!=''){
                $expensedatas = $expensedatas->where('billno', 'like', '%'.$request->arafaturano.'%');
            }
            if($request->arakasa!=''){
                $expensedatas = $expensedatas->where('safe_id', $request->arakasa);
            }
            if($request->aramatrah!=''){
                $expensedatas = $expensedatas->where('netprice',  'like', '%'.$request->aramatrah.'%');
            }
            if($request->arakdv!=''){
                $expensedatas = $expensedatas->where('tax', $request->arakdv);
            }
            // if($request->arakdvtutar!=''){
            //     $incomings = $incomings->where('sub_class_id', $request->arakdvtutar);
            // }
            if($request->araresmitutar!=''){
                $expensedatas = $expensedatas->where('officialprice', 'like', '%'. $request->araresmitutar.'%');
            }
            if($request->aragrtutar!=''){
                $expensedatas = $expensedatas->where('nonofficialprice', 'like', '%'. $request->aragrtutar.'%');
            }
            if($request->aratoplam!=''){
                $expensedatas = $expensedatas->where('totalprice', 'like', '%'. $request->aratoplam.'%');
            }
            if($request->aramonth!=''){
                $expensedatas = $expensedatas->where('month_period_id', $request->aramonth);
            }
            if($request->araozel!=''){
                $expensedatas = $expensedatas->where('private_period_id', $request->araozel);
            }
            $expensedatas = $expensedatas->get();
        }else{
            $firmselect = '';
            $incomings = '';
        }
        return view('expense.index', compact('firms', 'firmselect', 'monthperiods', 'privateperiods', 'expensedatas', 'expenses'));
    }
    public function save($id='', Request $request)
    {
        if($id==""){
            $expensedata = new ExpenseData();
            $expensedata->firm_id = $request->expense_firm_id;
        }else{
            $expensedata = ExpenseData::find($id);
        }
        $expensedata->type = $request->tip;
        $expensedata->kime = $request->borcluolunan;
        $expensedata->data_date = date('Y-m-d', strtotime(str_replace('/','-',$request->tarih)));
        $expensedata->detail = $request->detaynot;
        $expensedata->netprice = $request->matrah;
        $expensedata->tax = $request->kdv;
        $expensedata->officialprice = $request->resmitutar;
        $expensedata->nonofficialprice = $request->gresmitutar;
        $expensedata->totalprice = $request->toplamtutar;
        $expensedata->month_period_id = $request->monthperiod;
        $expensedata->private_period_id = $request->privateperiod;
        if($expensedata->save()){
            return redirect()->back()->with('success', 'Veri girişi yapıldı.');
        }else{
            return redirect()->back()->withError(['Bir hata oluştu.']);
        }
    }
}
