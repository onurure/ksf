<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SafeData;
use App\Incoming;
use App\Firm;

class SafeDataController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function save($id='', Request $request){
        if($id==""){
            $safedata = new SafeData();
        }else{
            $safedata = SafeData::find($id);
        }
        $safedata->safe_account_id = $request->safe_account_id;
        $safedata->data_date = date('Y-m-d', strtotime(str_replace('/','-',$request->tarih)));
        $safedata->banknote = $request->bankanot;
        $safedata->detailnote = $request->detaynot;
        $safedata->project = $request->proje;
        $safedata->incoming = $request->giren;
        $safedata->outgoing = $request->cikan;
        $safedata->tax = $request->kdv;
        $safedata->main_class_id = $request->mainclass;
        $safedata->sub_class_id = $request->subclass;
        $safedata->month_period_id = $request->monthperiod;
        $safedata->private_period_id = $request->privateperiod;
        if($request->approve=='on'){
            $safedata->approve = 1;
        }else{
            $safedata->approve = 0;
        }
        if($safedata->save()){
            if($safedata->main_class_id==1){
                $incomingdata = new Incoming();
                $incomingdata->firm_id = $safedata->safe_account->firm->id;
                $incomingdata->type = 2;
                $incomingdata->customer_id = $safedata->sub_class_id;
                $incomingdata->project = $safedata->project;
                $incomingdata->data_date = date('Y-m-d', strtotime(str_replace('/','-',$safedata->data_date)));
                $incomingdata->detail = $safedata->detailnote;
                $incomingdata->billno = '';
                $incomingdata->safe_id = $safedata->safe_account_id;
                $incomingdata->netprice = number_format($safedata->incoming/(100+$safedata->tax)*100,2,'','.');
                $incomingdata->tax = $safedata->tax;
                $incomingdata->officialprice = $safedata->incoming;
                $incomingdata->nonofficialprice = $safedata->gresmitutar;
                $incomingdata->totalprice = $safedata->incoming;
                $incomingdata->month_period_id = $safedata->month_period_id;
                $incomingdata->private_period_id = $safedata->private_period_id;
                $incomingdata->safe_data_id = $safedata->id;
                $incomingdata->save();
            }
            return redirect()->back()->with('success', 'Veri girişi yapıldı.');
        }else{
            return redirect()->back()->withError(['Bir hata oluştu.']);
        }
    }
    public function delete($id)
    {
        $safe = SafeData::find($id);
        if($safe->delete()){
            return redirect()->back()->with('success', 'Kasa verisi silindi.');
        }else{
            return redirect()->back()->withErrors(['Bir sorun oluştu.']);
        }
    }
}
