<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Firm;
use App\SafeAccount;
use App\Authority;
use App\MonthPeriod;
use App\PrivatePeriod;
use Illuminate\Support\Facades\DB;
use Auth;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $users = User::where('is_admin',0)->get();
        $allfirms = Firm::all();
        $safes = SafeAccount::all();
        $monthperiods = MonthPeriod::all();
        $privateperiods = PrivatePeriod::all();
        // if($request['user'] && $request['user'] != ''){
        //     foreach($allfirms as $allfirm){
        //         $firmuser = DB::select('select * from authorities where user_id = ? and firm_id = ?', [$request['user'], $allfirm->id ]);
        //         if(count($firmuser)>0){
        //             $allfirm['authority_type'] = $firmuser[0]->authority_type;
        //             $allfirm['account_authority'] = $firmuser[0]->account_authority;
        //             $allfirm['account_authority_edit'] = $firmuser[0]->account_authority_edit;
        //             $yfirms[] = $allfirm;
        //         }else{
        //             $firms[] = $allfirm;
        //         }
        //     }
        // }else{
        //     $firms = $allfirms;
        // }
        $firms = Firm::all();
        return view('user.index', compact('users','firms', 'safes', 'yfirms', 'monthperiods', 'privateperiods'));
    }
    public function save(Request $request)
    {
        $yfirms = Firm::all();
        $this->validate($request,[
            'name' =>  'required',
            'lastname' =>  'required',
            'username' =>  'required',
            'netkesif_email' =>  'required|email',
            'tcno'   =>  'required|integer',
            'phone'   =>  'required|integer',
            'email' => 'required|email',
            'photo' => 'image'
        ]);
        $data = $request->only(['name', 'lastname', 'username', 'tcno', 'phone', 'netkesif_email', 'email', 'status']);
        if($request->file('photo')){
            $file = $request->file('photo');
            $filename = str_slug(explode('.'.$file->getClientOriginalExtension(),$file->getClientOriginalName())[0]).'-'.uniqid().'.'.$file->getClientOriginalExtension();
            $file->move('images', $filename);
            $data['photo'] = 'images/'.$filename;
        }

        // $yfirms = $request['yfirms'];
        $accountjson = '';
        if($request['userid'] && $request['userid']!=''){
            if(User::find($request['userid'])->update($data)){
                $authuser = DB::delete('delete from authorities where user_id = ?', [$request['userid']]);
                for($i=0; $i<count($yfirms);$i++){
                    $gor = '';
                    $duz = '';
                    $privateperiods = array();
                    $monthperiods = array();
                    if($request['fid'.$yfirms[$i]->id]==2){
                        if(isset($request['gor'.$yfirms[$i]->id])){
                            $gor = implode(',',$request['gor'.$yfirms[$i]->id]);
                        }
                        if(isset($request['duz'.$yfirms[$i]->id])){
                            $duz = implode(',',$request['duz'.$yfirms[$i]->id]);
                        }
                        foreach($yfirms[$i]->safe_accounts as $safe_account){
                            if(isset($request['private'.$yfirms[$i]->id])){
                                foreach($request['private'.$yfirms[$i]->id] as $key => $val){
                                    if($key == $safe_account->id){
                                        $valtext = implode(',',$val);
                                        $privateperiods[$key] = $valtext;
                                    }
                                }
                            }
                            if(isset($request['month'.$yfirms[$i]->id])){
                                foreach($request['month'.$yfirms[$i]->id] as $key => $val){
                                    if($key == $safe_account->id){
                                        $monthperiods[$key] = implode(',',$val);
                                    }
                                }
                            }
                        }
                    }else{
                        $gor = '';
                        $duz = '';
                    }
                    // dd(json_encode($privateperiods));
                    $pp = json_encode($privateperiods);
                    $mp = json_encode($monthperiods);
                    // if(count($authuser)>0){
                    //     DB::update('update authorities set user_id = ?, firm_id = ?, authority_type = ?, account_authority = ?, account_authority_edit = ? where id = ?', [$request['userid'], $yfirms[$i], $request['fid'.$yfirms[$i]], $gor, $duz, $authuser[0]->id]);
                    // }else{
                    DB::insert('insert into authorities (user_id, firm_id, authority_type, account_authority, account_authority_edit, private_period, month_period) values (?, ?, ?, ?, ?, ?, ?)', [$request['userid'], $yfirms[$i]->id, $request['fid'.$yfirms[$i]->id], $gor, $duz, $pp, $mp]);
                    // }
                }
                return redirect("admin/users")->with('success', 'Kullanıcı güncellendi.');
            }else{
                return redirect("admin/users/user=".$request['userid'])->withError('Kullanıcı güncellenemedi.');
            }
        }else{
            $data['password'] = bcrypt('netkesif');
            if($user = User::create($data)){

                for($i=0; $i<count($yfirms);$i++){
                    $gor = '';
                    $duz = '';
                    $privateperiods = array();
                    $monthperiods = array();
                    if($request['fid'.$yfirms[$i]]==2){
                        if(isset($request['gor'.$yfirms[$i]])){
                            $gor = implode(',',$request['gor'.$yfirms[$i]]);
                        }
                        if(isset($request['duz'.$yfirms[$i]])){
                            $duz = implode(',',$request['duz'.$yfirms[$i]]);
                        }
                        foreach($yfirms[$i]->safe_accounts as $safe_account){
                            if(isset($request['private'.$yfirms[$i]->id])){
                                foreach($request['private'.$yfirms[$i]->id] as $key => $val){
                                    if($key == $safe_account->id){
                                        $valtext = implode(',',$val);
                                        $privateperiods[$key] = $valtext;
                                    }
                                }
                            }
                            if(isset($request['month'.$yfirms[$i]->id])){
                                foreach($request['month'.$yfirms[$i]->id] as $key => $val){
                                    if($key == $safe_account->id){
                                        $monthperiods[$key] = implode(',',$val);
                                    }
                                }
                            }
                        }
                    }else{
                        $gor = '';
                        $duz = '';
                    }
                    $pp = json_encode($privateperiods);
                    $mp = json_encode($monthperiods);
                    $authuser = DB::select('select * from authorities where user_id = ? and firm_id = ?', [$user->id,$yfirms[$i]]);
                    if(count($authuser)>0){
                        DB::update('update authorities set user_id = ?, firm_id = ?, authority_type = ?, account_authority = ?, account_authority_edit = ?, private_period = ?, month_period = ? where id = ?', [$user->id, $yfirms[$i], $request['fid'.$yfirms[$i]], $gor, $duz, $authuser[0]->id, $pp, $mp]);
                    }else{
                        DB::insert('insert into authorities (user_id, firm_id, authority_type, account_authority, account_authority_edit, private_period, month_period) values (?, ?, ?, ?, ?, ?, ?)', [$user->id, $yfirms[$i], $request['fid'.$yfirms[$i]], $gor, $duz, $pp, $mp]);
                    }
                }
            
                return redirect("admin/users?user=".$user->id)->with('success', 'Kullanıcı oluşturuldu.');
            }else{
                return redirect("admin/users")->withError('Kullanıcı oluşturulamadı.');
            }
        }
    }
}
