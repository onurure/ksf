<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Firm;
use App\SafeAccount;
use App\MainClass;
use App\PrivatePeriod;
use App\MonthPeriod;
use App\Customer;
use App\Expense;
use App\User;
use App\Incoming;

class IncomingController extends Controller
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
        $customers = Customer::all();
        if(isset($request->firm)){
            $firmselect = Firm::find($request->firm);
            $incomings = $firmselect->incomings()->orderBy('data_date');
            if($request->aramusteri!=''){
                $incomings = $incomings->where('customer_id', $request->aramusteri);
            }else if(isset($request->selectcustomer)){
                $incomings = $incomings->whereIn('customer_id', $request->selectcustomer);
            }
            if($request->aratarih!=''){
                $aratarih = date('Y-m-d', strtotime(str_replace('/','-',$request->aratarih)));
                $incomings = $incomings->where('data_date', $aratarih);
            }
            if($request->aratip!=''){
                $incomings = $incomings->where('type', $request->aratip);
            }
            if($request->aramusteri!=''){
                $incomings = $incomings->where('customer_id', $request->aramusteri);
            }
            if($request->araproje!=''){
                $incomings = $incomings->where('project', 'like', '%'.$request->araproje.'%');
            }
            if($request->aradetay!=''){
                $incomings = $incomings->where('detail', 'like', '%'.$request->aradetay.'%');
            }
            if($request->arafaturano!=''){
                $incomings = $incomings->where('billno', 'like', '%'.$request->arafaturano.'%');
            }
            if($request->arakasa!=''){
                $incomings = $incomings->where('safe_id', $request->arakasa);
            }
            if($request->aramatrah!=''){
                $incomings = $incomings->where('netprice',  'like', '%'.$request->aramatrah.'%');
            }
            if($request->arakdv!=''){
                $incomings = $incomings->where('tax', $request->arakdv);
            }
            // if($request->arakdvtutar!=''){
            //     $incomings = $incomings->where('sub_class_id', $request->arakdvtutar);
            // }
            if($request->araresmitutar!=''){
                $incomings = $incomings->where('officialprice', 'like', '%'. $request->araresmitutar.'%');
            }
            if($request->aragrtutar!=''){
                $incomings = $incomings->where('nonofficialprice', 'like', '%'. $request->aragrtutar.'%');
            }
            if($request->aratoplam!=''){
                $incomings = $incomings->where('totalprice', 'like', '%'. $request->aratoplam.'%');
            }
            if($request->aramonth!=''){
                $incomings = $incomings->where('month_period_id', $request->aramonth);
            }
            if($request->araozel!=''){
                $incomings = $incomings->where('private_period_id', $request->araozel);
            }
            $incomings = $incomings->get();
        }else{
            $firmselect = '';
            $incomings = '';
        }
        return view('incoming.index', compact('firms', 'firmselect', 'monthperiods', 'privateperiods', 'customers', 'incomings'));
    }
    public function arama(Request $request)
    {
        $firms = Firm::all();
        $privateperiods = PrivatePeriod::all();
        $monthperiods = MonthPeriod::all();
        $customers = Customer::all();
        if(isset($request->firm)){
            $firmselect = Firm::find($request->firm);
            $incomings = $firmselect->incomings();
            if($request->aratarih!=''){
                $aratarih = date('Y-m-d', strtotime(str_replace('/','-',$request->aratarih)));
                $incomings = $incomings->where('data_date', $aratarih);
            }
            if($request->aratip!=''){
                $incomings = $incomings->where('type', $request->aratip);
            }
            if($request->aramusteri!=''){
                $incomings = $incomings->where('customer_id', $request->aramusteri);
            }
            if(isset($request->selectcustomer)){
                $incomings = $incomings->whereIn('customer_id', $request->selectcustomer);
            }
            if($request->araproje!=''){
                $incomings = $incomings->where('project', 'like', '%'.$request->araproje.'%');
            }
            if($request->aradetay!=''){
                $incomings = $incomings->where('detail', 'like', '%'.$request->aradetay.'%');
            }
            if($request->arafaturano!=''){
                $incomings = $incomings->where('billno', 'like', '%'.$request->arafaturano.'%');
            }
            if($request->arakasa!=''){
                $incomings = $incomings->where('safe_id', $request->arakasa);
            }
            if($request->aramatrah!=''){
                $incomings = $incomings->where('netprice',  'like', '%'.$request->aramatrah.'%');
            }
            if($request->arakdv!=''){
                $incomings = $incomings->where('tax', $request->arakdv);
            }
            // if($request->arakdvtutar!=''){
            //     $incomings = $incomings->where('sub_class_id', $request->arakdvtutar);
            // }
            if($request->araresmitutar!=''){
                $incomings = $incomings->where('officialprice', 'like', '%'. $request->araresmitutar.'%');
            }
            if($request->aragrtutar!=''){
                $incomings = $incomings->where('nonofficialprice', 'like', '%'. $request->aragrtutar.'%');
            }
            if($request->aratoplam!=''){
                $incomings = $incomings->where('totalprice', 'like', '%'. $request->aratoplam.'%');
            }
            if($request->aramonth!=''){
                $incomings = $incomings->where('month_period_id', $request->aramonth);
            }
            if($request->araozel!=''){
                $incomings = $incomings->where('private_period_id', $request->araozel);
            }
            $incomings = $incomings->get();
        }else{
            $incomings = '';
        }
        return view('incoming.index', compact('firms', 'firmselect', 'monthperiods', 'privateperiods', 'customers', 'incomings'));
    }
    public function save($id='', Request $request)
    {
        if($id==""){
            $incomingdata = new Incoming();
            $incomingdata->firm_id = $request->incoming_firm_id;
        }else{
            $incomingdata = Incoming::find($id);
        }
        $incomingdata->type = $request->tip;
        $incomingdata->customer_id = $request->musteri;
        $incomingdata->project = $request->proje;
        $incomingdata->data_date = date('Y-m-d', strtotime(str_replace('/','-',$request->tarih)));
        $incomingdata->detail = $request->detaynot;
        $incomingdata->billno = $request->faturano;
        $incomingdata->safe_id = $request->kasa;
        $incomingdata->netprice = $request->matrah;
        $incomingdata->tax = $request->kdv;
        $incomingdata->officialprice = $request->resmitutar;
        $incomingdata->nonofficialprice = $request->gresmitutar;
        $incomingdata->totalprice = $request->toplamtutar;
        $incomingdata->month_period_id = $request->monthperiod;
        $incomingdata->private_period_id = $request->privateperiod;
        if($incomingdata->save()){
            return redirect()->back()->with('success', 'Veri girişi yapıldı.');
        }else{
            return redirect()->back()->withError(['Bir hata oluştu.']);
        }
    }
    public function ajax(Request $request)
    {
        if($request->name=='customer_name'){
            $safe = Customer::find($request->pk);
            $safe->name = $request->value;
            if($safe->save()){
                return response()->json(['success' => true]);
            }else{
                return response()->json(['success' => false]);
            }
        }
    }
    public function delete($id)
    {
        $safe = Incoming::find($id);
        if($safe->delete()){
            return redirect()->back()->with('success', 'Gerli verisi silindi.');
        }else{
            return redirect()->back()->withErrors(['Bir sorun oluştu.']);
        }
    }
}
