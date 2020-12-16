<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SafeData;
use App\Incoming;
use App\Firm;
use App\SafeAccount;
use App\MainClass;
use App\PrivatePeriod;
use App\MonthPeriod;
use App\Customer;
use App\User;
use DB;
use App\Exports\ReportExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Expense;
use App\ExpenseData;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function safeReport(Request $request)
    {
        $firms = Firm::all();
        $safes = SafeAccount::where('firm_id', $request->firm)->get();
        $projects = DB::table('safe_datas')->groupBy('project')->pluck('project');
        $mainclasses = MainClass::all();
        $monthperiods = MonthPeriod::all();
        $privateperiods = PrivatePeriod::all();
        $customers = Customer::all();
        $datas = '';
        if(isset($request->firm)){
            $firmselect = Firm::find($request->firm);
        }else{
            $firmselect = '';
        }
        return view('report.safe', compact('safes', 'projects', 'mainclasses', 'subclass', 'privateperiods', 'monthperiods', 'customers','firmselect','firms'));
    }
    public function safeReportPost(Request $request)
    {
        $datas = SafeData::query();

        if(isset($request->safes) && $request->safes != '' ){
            $datas = $datas->whereIn('safe_account_id', $request->safes);
        }

        if(isset($request->projects) && $request->projects != '' ){
            $datas = $datas->whereIn('project', $request->projects);
        }

        if(isset($request->mainclasses) && $request->mainclasses != '' ){
            $datas = $datas->whereIn('main_class_id', $request->mainclasses);
        }

        if(isset($request->subclasses) && $request->subclasses != '' ){
            if(in_array(8, $request->mainclasses)){
                $datas = $datas->where(function ($query) use ($request) {
                    $query->whereIn('sub_class_id', $request->subclasses)
                          ->orWhereNull('sub_class_id');
                });
            }else{
                $datas = $datas->whereIn('sub_class_id', $request->subclasses);
            }
        }

        if(isset($request->monthperiods) && $request->monthperiods != '' ){
            $datas = $datas->whereIn('month_period_id', $request->monthperiods);
        }

        if(isset($request->privateperiods) && $request->privateperiods != '' ){
            $datas = $datas->whereIn('private_period_id', $request->privateperiods);
        }

        if(isset($request->aratarih) && $request->aratarih != ''){
            $boltarih = explode(' - ', $request->aratarih);
            $datas = $datas->whereDate('data_date', '>=', date('Y-m-d', strtotime($boltarih[0])))->whereDate('data_date', '<=', date('Y-m-d', strtotime($boltarih[1])));
        }
        
        $datas = $datas->get();

        if($datas){
            foreach($datas as $ss){
                $nestedData[0] = $ss->safe_account->name;
                $nestedData[1] = date('d-m-Y', strtotime(str_replace('-', '/', $ss->data_date)));
                $nestedData[2] = $ss->banknote;
                $nestedData[3] = $ss->detailnote;
                $nestedData[4] = $ss->project;
                $nestedData[5] = $ss->incoming>0 ? number_format($ss->incoming/100, 2, ",", ".") : '';
                $nestedData[6] = $ss->outgoing>0 ? number_format($ss->outgoing/100, 2, ",", ".") : '';
                $nestedData[7] = $ss->incoming!=0||$ss->incoming!='' ? number_format($ss->incoming/(100+$ss->tax),2,'.','') : number_format($ss->outgoing/(100+$ss->tax),2,'.','');
                $nestedData[8] = '% '.$ss->tax;
                $mainclass = MainClass::find($ss->main_class_id);
                $nestedData[9] = $mainclass->name;
                if($ss->main_class_id==1){
                    $dvalue = Customer::find($ss->sub_class_id);
                }else if($ss->main_class_id==2){
                    $dvalue = Expense::find($ss->sub_class_id);
                }else if($ss->main_class_id==3){
                    $dvalue = User::find($ss->sub_class_id);
                }else if($ss->main_class_id==4){
                    $dvalue = User::find($ss->sub_class_id);
                }else if($ss->main_class_id==5){
                    $dvalue = User::find($ss->sub_class_id);
                }else if($ss->main_class_id==6){
                    $dvalue = User::find($ss->sub_class_id);
                }else if($ss->main_class_id==7){
                    $dvalue = SafeAccount::find($ss->sub_class_id);
                }
                if($dvalue){
                    if($dvalue->lastname){
                        $nestedData[10] = $dvalue->name.' '.$dvalue->lastname;
                    }else{
                        $nestedData[10] = $dvalue->name;
                    }
                }else{
                    $nestedData[10] = '';
                }

                $aydonemi = MonthPeriod::find($ss->month_period_id);
                $nestedData[11] = $aydonemi->m_name.' '.$aydonemi->y_name;

                $ozeldonemi = PrivatePeriod::find($ss->private_period_id);
                $nestedData[12] = $ozeldonemi->name;
                $x[] = $nestedData;
            }
        }
        $json_data = array(
            "draw" => $request->draw,
            "recordsTotal" => isset($datas) ? count($datas) : 0,
            "recordsFiltered" => isset($datas) ? count($datas) : 0,
            "data" => isset($x) ? $x : ''
        );
        
        return response()->json($json_data);

        // return view('report.safe', compact('safes', 'projects', 'mainclasses', 'subclass', 'privateperiods', 'monthperiods', 'customers', 'datas'));
    }

    public function safeReportPostt(Request $request)
    {
        $safedata = SafeData::find(1);
        
        for($i=0; $i<1000; $i++) {
            $safedata->replicate()->save();
        }

        return response()->json(['asd']);
    }
    public function reportExport(Request $request){
        $datas = $request->filtered_datas;
        return Excel::download(new ReportExport($datas), 'report.xlsx'); 
    }
    public function incomeReport(Request $request)
    {
        $firms = Firm::all();
        $projects = DB::table('safe_datas')->groupBy('project')->pluck('project');
        $monthperiods = MonthPeriod::all();
        $privateperiods = PrivatePeriod::all();
        $customers = Customer::all();
        $datas = '';
        if(isset($request->firm)){
            $firmselect = Firm::find($request->firm);
        }else{
            $firmselect = '';
        }
        return view('report.incoming', compact('projects', 'privateperiods', 'monthperiods', 'customers', 'firmselect', 'firms'));
    }
    public function incomeReportPost(Request $request)
    {
        $datas = Incoming::query();

        if(isset($request->projects) && $request->projects != '' ){
            $datas = $datas->whereIn('project', $request->projects);
        }
        
        if(isset($request->customers) && $request->customers != '' ){
            $datas = $datas->whereIn('customer_id', $request->customers);
        }
        
        if(isset($request->geliralacak) && $request->geliralacak != '' ){
            $datas = $datas->whereIn('type', $request->geliralacak);
        }

        if(isset($request->monthperiods) && $request->monthperiods != '' ){
            $datas = $datas->whereIn('month_period_id', $request->monthperiods);
        }

        if(isset($request->privateperiods) && $request->privateperiods != '' ){
            $datas = $datas->whereIn('private_period_id', $request->privateperiods);
        }

        if(isset($request->aratarih) && $request->aratarih != ''){
            $boltarih = explode(' - ', $request->aratarih);
            $datas = $datas->whereDate('data_date', '>=', date('Y-m-d', strtotime($boltarih[0])))->whereDate('data_date', '<=', date('Y-m-d', strtotime($boltarih[1])));
        }
        
        $datas = $datas->get();

        if($datas){
            foreach($datas as $ss){
                if($ss->type==1){
                    $tip = "FATURA KESİLMESİ";
                }else if($ss->type==2){
                    $tip = "TAHSİLAT GİRİŞİ";
                }else if($ss->type==3){
                    $tip = "TAMAMLANMIŞ İŞ";
                }else if($ss->type==4){
                    $tip = "BATIK İŞ";
                }
                $nestedData[0] = $tip;
                $dvalue = Customer::find($ss->customer_id);
                $nestedData[1] = $dvalue->name;
                $nestedData[2] = $ss->project;
                $nestedData[3] = date('d-m-Y', strtotime(str_replace('-', '/', $ss->data_date)));
                $nestedData[4] = $ss->detail;
                $nestedData[5] = $ss->billno;
                $o = SafeAccount::find($ss->safe_id);
                $nestedData[6] = $o->name;
                $nestedData[7] = $ss->netprice>0 ? number_format($ss->netprice/100, 2, ",", ".") : '';
                $nestedData[8] = '% '.$ss->tax;
                $nestedData[9] = number_format($ss->netprice/(100+$ss->tax),2,'.','');
                $nestedData[10] = number_format($ss->officialprice,2,'.','');
                $nestedData[11] = number_format($ss->nonofficialprice,2,'.','');
                $nestedData[12] = number_format($ss->totalprice,2,'.','');

                $aydonemi = MonthPeriod::find($ss->month_period_id);
                $nestedData[13] = $aydonemi->m_name.' '.$aydonemi->y_name;

                $ozeldonemi = PrivatePeriod::find($ss->private_period_id);
                $nestedData[14] = $ozeldonemi->name;
                $x[] = $nestedData;
            }
        }
        $json_data = array(
            "draw" => $request->draw,
            "recordsTotal" => isset($datas) ? count($datas) : 0,
            "recordsFiltered" => isset($datas) ? count($datas) : 0,
            "data" => isset($x) ? $x : ''
        );
        
        return response()->json($json_data);

        // return view('report.safe', compact('safes', 'projects', 'mainclasses', 'subclass', 'privateperiods', 'monthperiods', 'customers', 'datas'));
    }
    public function expenseReport(Request $request)
    {
        $firms = Firm::all();
        $kime = DB::table('expense_datas')->groupBy('kime')->pluck('kime');
        $monthperiods = MonthPeriod::all();
        $privateperiods = PrivatePeriod::all();
        $expenses = Expense::all();
        $datas = '';
        if(isset($request->firm)){
            $firmselect = Firm::find($request->firm);
        }else{
            $firmselect = '';
        }
        return view('report.expense', compact('kime', 'privateperiods', 'monthperiods', 'expenses', 'firmselect', 'firms'));
    }
    public function expenseReportPost(Request $request)
    {
        $datas = ExpenseData::query();

        if(isset($request->kime) && $request->kime != '' ){
            $datas = $datas->whereIn('kime', $request->kime);
        }
        
        if(isset($request->expensetip) && $request->expensetip != '' ){
            $datas = $datas->whereIn('type', $request->expensetip);
        }

        if(isset($request->monthperiods) && $request->monthperiods != '' ){
            $datas = $datas->whereIn('month_period_id', $request->monthperiods);
        }

        if(isset($request->privateperiods) && $request->privateperiods != '' ){
            $datas = $datas->whereIn('private_period_id', $request->privateperiods);
        }

        if(isset($request->aratarih) && $request->aratarih != ''){
            $boltarih = explode(' - ', $request->aratarih);
            $datas = $datas->whereDate('data_date', '>=', date('Y-m-d', strtotime($boltarih[0])))->whereDate('data_date', '<=', date('Y-m-d', strtotime($boltarih[1])));
        }
        
        $datas = $datas->get();

        if($datas){
            foreach($datas as $ss){
                $expensetip = Expense::find($ss->type);
                $nestedData[0] = $expensetip->name;
                $nestedData[1] = $ss->kime;
                $nestedData[2] = date('d-m-Y', strtotime(str_replace('-', '/', $ss->data_date)));
                $nestedData[3] = $ss->detail;
                $nestedData[4] = $ss->netprice>0 ? number_format($ss->netprice/100, 2, ",", ".") : '';
                $nestedData[5] = '% '.$ss->tax;
                $nestedData[6] = number_format($ss->netprice/(100+$ss->tax),2,'.','');
                $nestedData[7] = number_format($ss->officialprice,2,'.','');
                $nestedData[8] = number_format($ss->nonofficialprice,2,'.','');
                $nestedData[9] = number_format($ss->totalprice,2,'.','');

                $aydonemi = MonthPeriod::find($ss->month_period_id);
                $nestedData[10] = $aydonemi->m_name.' '.$aydonemi->y_name;

                $ozeldonemi = PrivatePeriod::find($ss->private_period_id);
                $nestedData[11] = $ozeldonemi->name;
                $x[] = $nestedData;
            }
        }
        $json_data = array(
            "draw" => $request->draw,
            "recordsTotal" => isset($datas) ? count($datas) : 0,
            "recordsFiltered" => isset($datas) ? count($datas) : 0,
            "data" => isset($x) ? $x : ''
        );
        
        return response()->json($json_data);

        // return view('report.safe', compact('safes', 'projects', 'mainclasses', 'subclass', 'privateperiods', 'monthperiods', 'customers', 'datas'));
    }
    public function summaryReport(Request $request)
    {
        $firms = Firm::all();
        if(isset($request->firm)){
            $firmselect = Firm::find($request->firm);
        }else{
            $firmselect = '';
        }
        $monthperiods = MonthPeriod::all();
        $privateperiods = PrivatePeriod::all();
        $customers = Customer::all();
        $datas = '';
        $personel = User::where('status', 1)->where('is_admin',0)->select('id', 'name', 'lastname')->get();
        return view('report.summary', compact('privateperiods', 'monthperiods', 'firmselect', 'firms', 'customers', 'personel'));
    }
    public function summaryReportPost(Request $request)
    {
        $gelirarray = array();
        $giderarray = array();
        $borcarray = array();
        $firms = Firm::all();
        if(isset($request->firm)){
            $firmselect = Firm::find($request->firm);
        }else{
            $firmselect = '';
        }
        $monthperiods = MonthPeriod::all();
        $privateperiods = PrivatePeriod::all();
        $customers = Customer::all();
        $personel = User::where('status', 1)->where('is_admin',0)->select('id', 'name', 'lastname')->get();
        if($request->rapor==1){
            $datas = DB::table('incomings')
                    ->join('customers', 'incomings.customer_id', '=', 'customers.id')
                    ->join('month_periods', 'incomings.month_period_id', '=', 'month_periods.id')
                    ->select('incomings.customer_id', 'incomings.month_period_id', 'customers.name', 'month_periods.m_name', 'month_periods.y_name', DB::raw('SUM(case when incomings.type = 1 then incomings.totalprice else 0 end) as total1'), DB::raw('SUM(case when incomings.type = 2 then incomings.totalprice else 0 end) as total2'), DB::raw('SUM(case when incomings.type = 3 then incomings.totalprice else 0 end) as total3'));
            $giders = DB::table('safe_datas')->select('month_period_id', DB::raw('SUM(outgoing) as total4'));
            $gelirs = DB::table('safe_datas')->select('month_period_id', DB::raw('SUM(incoming) as total5'));
            $borcs = DB::table('expense_datas')->select('month_period_id', DB::raw('SUM(totalprice) as total6'))->where('firm_id',$request->firm);
            if(isset($request->customers) && $request->customers != '' ){
                $datas = $datas->whereIn('incomings.customer_id', $request->customers);
            }

            if(isset($request->monthperiods) && $request->monthperiods != '' ){
                $datas = $datas->whereIn('incomings.month_period_id', $request->monthperiods);
                $giders = $giders->whereIn('month_period_id', $request->monthperiods);
                $gelirs = $gelirs->whereIn('month_period_id', $request->monthperiods);
                $borcs = $borcs->whereIn('month_period_id', $request->monthperiods);
            }

            if(isset($request->privateperiods) && $request->privateperiods != '' ){
                $datas = $datas->whereIn('incomings.private_period_id', $request->privateperiods);
                $giders = $giders->whereIn('private_period_id', $request->privateperiods);
                $gelirs = $gelirs->whereIn('private_period_id', $request->privateperiods);
                $borcs = $borcs->whereIn('private_period_id', $request->privateperiods);
            }

            if(isset($request->aratarih) && $request->aratarih != ''){
                $boltarih = explode(' - ', $request->aratarih);
                $datas = $datas->whereDate('incomings.data_date', '>=', date('Y-m-d', strtotime($boltarih[0])))->whereDate('incomings.data_date', '<=', date('Y-m-d', strtotime($boltarih[1])));
                $giders = $giders->whereDate('data_date', '>=', date('Y-m-d', strtotime($boltarih[0])))->whereDate('data_date', '<=', date('Y-m-d', strtotime($boltarih[1])));
                $gelirs = $gelirs->whereDate('data_date', '>=', date('Y-m-d', strtotime($boltarih[0])))->whereDate('data_date', '<=', date('Y-m-d', strtotime($boltarih[1])));
                $borcs = $borcs->whereDate('data_date', '>=', date('Y-m-d', strtotime($boltarih[0])))->whereDate('data_date', '<=', date('Y-m-d', strtotime($boltarih[1])));
            }
            
            $datas = $datas->groupBy(['incomings.month_period_id', 'incomings.customer_id'])->orderBy('incomings.month_period_id')->get();
            $giders = $giders->groupBy('month_period_id')->orderBy('month_period_id')->get();
            foreach($giders as $gider){
                $giderarray[$gider->month_period_id] = $gider->total4;
            }
            $gelirs = $gelirs->groupBy('month_period_id')->orderBy('month_period_id')->get();
            foreach($gelirs as $gelir){
                $gelirarray[$gelir->month_period_id] = $gelir->total5;
            }
            $borcs = $borcs->groupBy('month_period_id')->orderBy('month_period_id')->get();
            foreach($borcs as $borc){
                $borcarray[$borc->month_period_id] = $borc->total6;
            }
        }else if($request->rapor==2){
        }else if($request->rapor==3){
            $datas = DB::table('safe_datas')
                    ->join('users', 'safe_datas.sub_class_id', 'users.id')
                    ->join('month_periods', 'safe_datas.month_period_id', '=', 'month_periods.id')
                    ->select('safe_datas.month_period_id', 'safe_datas.sub_class_id', 'users.name', 'users.lastname', 'month_periods.m_name', 'month_periods.y_name', DB::raw('SUM(case when safe_datas.main_class_id = 3 then safe_datas.incoming else 0 end) as total1'), DB::raw('SUM(case when safe_datas.main_class_id = 4 then safe_datas.incoming else 0 end) as total2'), DB::raw('SUM(case when safe_datas.main_class_id = 5 then safe_datas.incoming else 0 end) as total3'))
                    ->whereIn('safe_datas.main_class_id', [3,4,5]);

            if(isset($request->personels) && $request->personels != '' ){
                $datas = $datas->whereIn('safe_datas.sub_class_id', $request->personels);
            }

            if(isset($request->monthperiods) && $request->monthperiods != '' ){
                $datas = $datas->whereIn('safe_datas.month_period_id', $request->monthperiods);
            }

            if(isset($request->privateperiods) && $request->privateperiods != '' ){
                $datas = $datas->whereIn('safe_datas.private_period_id', $request->privateperiods);
            }

            if(isset($request->aratarih) && $request->aratarih != ''){
                $boltarih = explode(' - ', $request->aratarih);
                $datas = $datas->whereDate('safe_datas.data_date', '>=', date('Y-m-d', strtotime($boltarih[0])))->whereDate('safe_datas.data_date', '<=', date('Y-m-d', strtotime($boltarih[1])));
            }
            $datas = $datas->groupBy(['safe_datas.month_period_id', 'safe_datas.sub_class_id'])->orderBy('safe_datas.month_period_id')->get();
        }
        
// dd($gelirs);
        return view('report.summary', compact('privateperiods', 'monthperiods', 'customers', 'datas', 'firmselect', 'firms', 'personel', 'gelirarray', 'giderarray', 'borcarray'));
    }
}
