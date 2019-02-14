<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Firm;
use Illuminate\Support\Facades\DB;

class FirmsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $allusers = User::where('is_admin',0)->get();
        $firms = Firm::all();
        $partners = [];
        $users = [];
        if($request['firm'] && $request['firm'] != ''){
            foreach($allusers as $alluser){
                $firmuser = DB::select('select * from firm_user where user_id = ? and firm_id = ?', [$alluser->id, $request['firm']]);
                if(count($firmuser)>0){
                    $alluser['percentage'] = $firmuser[0]->percentage;
                    $partners[] = $alluser;
                }else{
                    $users[] = $alluser;
                }
            }
        }else{
            $users = $allusers;
        }
        return view('admin.index', compact('users','firms', 'partners'));
    }
    public function save(Request $request)
    {
        $this->validate($request,[
            'name' =>  'required',
            'tax' =>  'required',
            'taxno'   =>  'required|integer',
            'telephone'   =>  'required|integer',
            'address' => 'required',
            'logo' => 'image'
        ]);
        $firmvalues = $request->only(['name', 'tax', 'taxno', 'address', 'telephone']);
        if($request->file('logo')){
            $file = $request->file('logo');
            $filename = str_slug(explode('.'.$file->getClientOriginalExtension(),$file->getClientOriginalName())[0]).'-'.uniqid().'.'.$file->getClientOriginalExtension();
            $file->move('images', $filename);
            $firmvalues['logo'] = 'images/'.$filename;
        }
        $partners = $request['partners'];
        $perc = $request['percentage'];
        if($request['firmid'] && $request['firmid']!=''){
            if(Firm::find($request['firmid'])->update($firmvalues)){
                if($request['partners']){
                    for($i=0; $i<count($partners);$i++){
                        $firmuser = DB::select('select * from firm_user where user_id = ? and firm_id = ?', [$partners[$i], $request['firmid']]);
                        if(count($firmuser)>0){
                            DB::update('update firm_user set user_id = ?, firm_id = ?, percentage = ? where id = ?', [$partners[$i], $request['firmid'], $perc[$i], $firmuser[0]->id]);
                        }else{
                            DB::insert('insert into firm_user (user_id, firm_id, percentage) values (?, ?, ?)', [$partners[$i], $request['firmid'], $perc[$i]]);
                        }
                    }
                }else{
                    $firmuser = DB::select('select * from firm_user where firm_id = ?', [$request['firmid']]);
                    if(count($firmuser)>0){
                        DB::delete('delete from firm_user where id = ?', [$firmuser[0]->id]);
                    }
                }
                return redirect("admin")->with('success', 'Firma güncellendi.');
            }else{
                return redirect("admin/firma=".$request['firmid'])->withError('Firma güncellenemedi.');
            }
        }else{
            if($firm = Firm::create($firmvalues)){
                if($request['partners']){
                    for($i=0; $i<count($partners);$i++){
                        DB::insert('insert into firm_user (user_id, firm_id, percentage) values (?, ?, ?)', [$partners[$i], $firm->id, $perc[$i]]);
                    }
                }
                return redirect("admin")->with('success', 'Firma oluşturuldu.');
            }else{
                return redirect("admin")->withError('Firma oluşturulamadı.');
            }
        }
    }
    public function delete($firmid)
    {
        if(Firm::find($firmid)->delete()){
            DB::table('safe_accounts')->where('firm_id', $firmid)->delete();
            DB::table('firm_user')->where('firm_id', $firmid)->delete();
            DB::table('authorities')->where('firm_id', $firmid)->delete();
            return redirect("admin")->with('success', 'Firma silindi.');
        }else{
            return redirect("admin/firma=".$firmid)->withError('Firma silinemedi.');
        }
    }

}