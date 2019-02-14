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
use App\SafeData;

class SafeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $aramami = 0;
        $firms = Firm::all();
        $safeaccounts = SafeAccount::where('firm_id', $request->firmid)->pluck('name', 'id');
        $mainclasses = MainClass::all();
        $privateperiods = PrivatePeriod::all();
        $monthperiods = MonthPeriod::all();
        $customers = Customer::all();
        $expense = Expense::all();
        $personel = User::where('status', $request->aradetay)->where('is_admin',0)->select('id', 'name', 'lastname')->get();
        if(isset($request->firm)){
            $firmselect = Firm::find($request->firm);
            $data = Firm::find($request->firm)->users()->select('users.id', 'name', 'lastname')->get();
            foreach($data as $d){
                $name = $d->name.' '.$d->lastname;
                $ortaklar[] = (object) ['id' => $d->id, 'name' => $name];
            }
        }else{
            $firmselect = '';
        }
        if(isset($request->safe)){
            // $safeselect = SafeAccount::find($request->safe)->safe_datas();

            $safeselect = SafeData::where('safe_account_id', $request->safe)->orWhere(function ($query) use ($request){
                $query->where('main_class_id', 7)
                      ->Where('sub_class_id', $request->safe);
            });
            if($request->aratarih!=''){
                $aratarih = date('Y-m-d', strtotime(str_replace('/','-',$request->aratarih)));
                $safeselect = $safeselect->where('data_date', $aratarih);
                $aramami = 1;
            }
            if($request->arabanka!=''){
                $safeselect = $safeselect->where('banknote', 'like', '%'.$request->arabanka.'%');
                $aramami = 1;
            }
            if($request->aradetay!=''){
                $safeselect = $safeselect->where('detailnote', 'like', '%'.$request->aradetay.'%');
                $aramami = 1;
            }
            if($request->araproje!=''){
                $safeselect = $safeselect->where('project', 'like', '%'.$request->araproje.'%');
                $aramami = 1;
            }
            if($request->aragiren!=''){
                $safeselect = $safeselect->where('incoming', 'like', '%'.$request->aragiren.'%');
                $aramami = 1;
            }
            if($request->aracikan!=''){
                $safeselect = $safeselect->where('outgoing', 'like', '%'.$request->aracikan.'%');
                $aramami = 1;
            }
            if($request->arakdv!=''){
                $safeselect = $safeselect->where('tax', $request->arakdv);
                $aramami = 1;
            }
            if($request->aramain!=''){
                $safeselect = $safeselect->where('main_class_id', $request->aramain);
                $aramami = 1;
            }
            if($request->arasub!=''){
                $safeselect = $safeselect->where('sub_class_id', $request->arasub);
                $aramami = 1;
            }
            if($request->aramonth!=''){
                $safeselect = $safeselect->where('month_period_id', $request->aramonth);
                $aramami = 1;
            }
            if($request->araozel!=''){
                $safeselect = $safeselect->where('private_period_id', $request->araozel);
                $aramami = 1;
            }
            if($request->araapprove!=''){
                if($request->araapprove==1){
                    $safeselect = $safeselect->where('approve', 1);
                    $aramami = 1;
                }else{
                    $safeselect = $safeselect->where('approve', 0);
                    $aramami = 1;
                }
            }
            $safeselect = $safeselect->orderBy('data_date')->get();
            $hatalitoplam = 0;
            foreach($safeselect as $s){
                if($s->main_class_id=="8"){
                    if($s->incoming!=""||$s->incoming!=0){
                        $hatalitoplam = $hatalitoplam + $s->incoming;
                    }else{
                        $hatalitoplam = $hatalitoplam - $s->outgoing;
                    }
                }
            }
        }else{
            $hatalitoplam = 0;
            $safeselect = '';
        }
        return view('safeaccount.index', compact('firms', 'safeaccounts', 'firmselect', 'mainclasses', 'monthperiods', 'privateperiods', 'customers', 'safeselect', 'personel', 'ortaklar', 'expense','hatalitoplam'));
    }
    public function arama(Request $request)
    {
        $firms = Firm::all();
        $safeaccounts = SafeAccount::where('firm_id', $request->firmid)->pluck('name', 'id');
        $mainclasses = MainClass::all();
        $privateperiods = PrivatePeriod::all();
        $monthperiods = MonthPeriod::all();
        $customers = Customer::all();
        $expense = Expense::all();
        $personel = User::where('status', $request->aradetay)->where('is_admin',0)->select('id', 'name', 'lastname')->get();
        if(isset($request->firm)){
            $firmselect = Firm::find($request->firm);
            $data = Firm::find($request->firm)->users()->select('users.id', 'name', 'lastname')->get();
            foreach($data as $d){
                $name = $d->name.' '.$d->lastname;
                $ortaklar[] = (object) ['id' => $d->id, 'name' => $name];
            }
        }else{
            $firmselect = '';
        }
        if(isset($request->safe)){
            $safeselect = SafeAccount::find($request->safe)->safe_datas();
            if($request->aratarih!=''){
                $aratarih = date('Y-m-d', strtotime(str_replace('/','-',$request->aratarih)));
                $safeselect = $safeselect->where('data_date', $aratarih);
            }
            if($request->arabanka!=''){
                $safeselect = $safeselect->where('banknote', $request->arabanka);
            }
            if($request->aradetay!=''){
                $safeselect = $safeselect->where('detailnote', $request->aradetay);
            }
            if($request->araproje!=''){
                $safeselect = $safeselect->where('project', $request->araproje);
            }
            if($request->aragiren!=''){
                $safeselect = $safeselect->where('incoming', $request->aragiren);
            }
            if($request->aracikan!=''){
                $safeselect = $safeselect->where('outgoing', $request->aracikan);
            }
            if($request->arakdv!=''){
                $safeselect = $safeselect->where('tax', $request->arakdv);
            }
            if($request->aramain!=''){
                $safeselect = $safeselect->where('main_class_id', $request->aramain);
            }
            if($request->arasub!=''){
                $safeselect = $safeselect->where('sub_class_id', $request->arasub);
            }
            if($request->aramonth!=''){
                $safeselect = $safeselect->where('month_period_id', $request->aramonth);
            }
            if($request->araozel!=''){
                $safeselect = $safeselect->where('private_period_id', $request->araozel);
            }
            if($request->araapprove!=''){
                if($request->araapprove==1){
                    $safeselect = $safeselect->where('approve', 1);
                }else{
                    $safeselect = $safeselect->where('approve', 0);
                }
            }
            $hatalitoplam = 0;
            foreach($safeselect as $s){
                if($s->main_class_id=="8"){
                    if($s->incoming!=""||$s->incoming!=0){
                        $hatalitoplam = $hatalitoplam + $s->incoming;
                    }else{
                        $hatalitoplam = $hatalitoplam - $s->outgoing;
                    }
                }
            }
            $safeselect = $safeselect->get();
        }else{
            $hatalitoplam = 0;
            $safeselect = '';
        }
        return view('safeaccount.index', compact('firms', 'safeaccounts', 'firmselect', 'mainclasses', 'monthperiods', 'privateperiods', 'customers', 'safeselect', 'personel', 'ortaklar', 'expense', 'hatalitoplam'));
    }
    public function save(Request $request)
    {
        if(isset($request->firm)&&isset($request->safe_name)){
            $kasa = new SafeAccount();
            $kasa->name = $request->safe_name;
            $kasa->firm_id = $request->firm;
            if($kasa->save()){
                return redirect()->back()->with('success', 'Kasa oluşturuldu.');
            }else{
                return redirect()->back()->withError(['Bir hata oluştu.']);
            }
        }else{
            return redirect()->back()->withErrors(['Firma seçilmeli ve kasa adı girilmelidir.']);
        }
    }
    public function ajax(Request $request)
    {
        if($request->name=='safe_name'){
            $safe = SafeAccount::find($request->pk);
            $safe->name = $request->value;
            if($safe->save()){
                return response()->json(['success' => true]);
            }else{
                return response()->json(['success' => false]);
            }
        }
    }
    public function saveApprove(Request $request)
    {
        foreach(json_decode($request->secilmisler) as $s){
            $safedata = SafeData::find($s->id);
            $safedata->approve = 1;
            $safedata->save();
        }
        return redirect()->back()->with('success', 'Veriler onaylandı.');
    }
    public function delete($id)
    {
        $safe = SafeAccount::find($id);
        if($safe->safe_datas->count()>0){
            return redirect()->back()->withErrors(['Verisi olan kasa silinemez.']);
        }else{
            $firm = $safe->firm->id;
            $safe->delete();
            return redirect('safeaccount?firm='.$firm)->with('success', 'Kasa silindi.');
        }
    }
}
