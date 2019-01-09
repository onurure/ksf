<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Firm;
use App\SafeAccount;
use App\Authority;
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
        if($request['user'] && $request['user'] != ''){
            foreach($allfirms as $allfirm){
                $firmuser = DB::select('select * from authorities where user_id = ? and firm_id = ?', [$request['user'], $allfirm->id ]);
                if(count($firmuser)>0){
                    $allfirm['authority_type'] = $firmuser[0]->authority_type;
                    $allfirm['account_authority'] = $firmuser[0]->account_authority;
                    $allfirm['account_authority_edit'] = $firmuser[0]->account_authority_edit;
                    $yfirms[] = $allfirm;
                }else{
                    $firms[] = $allfirm;
                }
            }
        }else{
            $firms = $allfirms;
        }
        return view('user.index', compact('users','firms', 'safes', 'yfirms'));
    }
    public function save(Request $request)
    {
        $data = $request->only(['name', 'lastname', 'username', 'tcno', 'phone', 'netkesif_email', 'email', 'status']);
        if($request->file('photo')){
            $file = $request->file('photo');
            $filename = str_slug(explode('.'.$file->getClientOriginalExtension(),$file->getClientOriginalName())[0]).'-'.uniqid().'.'.$file->getClientOriginalExtension();
            $file->move('images', $filename);
            $data['photo'] = 'images/'.$filename;
        }
        $yfirms = $request['yfirms'];
        $accountjson = '';
        if($request['userid'] && $request['userid']!=''){
            if(User::find($request['userid'])->update($data)){
                $authuser = DB::delete('delete from authorities where user_id = ?', [$request['userid']]);
                if($request['yfirms']){
                    for($i=0; $i<count($yfirms);$i++){
                        $gor = '';
                        $duz = '';
                        if($request['fid'.$yfirms[$i]]==2){
                            if(isset($request['gor'.$yfirms[$i]])){
                                $gor = implode(',',$request['gor'.$yfirms[$i]]);
                            }
                            if(isset($request['duz'.$yfirms[$i]])){
                                $duz = implode(',',$request['duz'.$yfirms[$i]]);
                            }
                        }else{
                            $gor = '';
                            $duz = '';
                        }
                        // if(count($authuser)>0){
                        //     DB::update('update authorities set user_id = ?, firm_id = ?, authority_type = ?, account_authority = ?, account_authority_edit = ? where id = ?', [$request['userid'], $yfirms[$i], $request['fid'.$yfirms[$i]], $gor, $duz, $authuser[0]->id]);
                        // }else{
                        DB::insert('insert into authorities (user_id, firm_id, authority_type, account_authority, account_authority_edit) values (?, ?, ?, ?, ?)', [$request['userid'], $yfirms[$i], $request['fid'.$yfirms[$i]], $gor, $duz]);
                        // }
                    }
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
                    if($request['fid'.$yfirms[$i]]==2){
                        if(isset($request['gor'.$yfirms[$i]])){
                            $gor = implode(',',$request['gor'.$yfirms[$i]]);
                        }
                        if(isset($request['duz'.$yfirms[$i]])){
                            $duz = implode(',',$request['duz'.$yfirms[$i]]);
                        }
                    }else{
                        $gor = '';
                        $duz = '';
                    }
                    $authuser = DB::select('select * from authorities where user_id = ? and firm_id = ?', [$user->id,$yfirms[$i]]);
                    if(count($authuser)>0){
                        DB::update('update authorities set user_id = ?, firm_id = ?, authority_type = ?, account_authority = ?, account_authority_edit = ? where id = ?', [$user->id, $yfirms[$i], $request['fid'.$yfirms[$i]], $gor, $duz, $authuser[0]->id]);
                    }else{
                        DB::insert('insert into authorities (user_id, firm_id, authority_type, account_authority, account_authority_edit) values (?, ?, ?, ?, ?)', [$user->id, $yfirms[$i], $request['fid'.$yfirms[$i]], $gor, $duz]);
                    }
                }
            
                return redirect("admin/users?user=".$user->id)->with('success', 'Kullanıcı oluşturuldu.');
            }else{
                return redirect("admin/users")->withError('Kullanıcı oluşturulamadı.');
            }
        }
    }
}
