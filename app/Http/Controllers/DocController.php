<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Document;

class DocController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create($type, $type_id)
    {
        $docs = Document::where('type', $type)->where('type_id', $type_id)->get();
        return response()->json($docs);
    }
    public function save(Request $request)
    {
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('images/'.uniqid()),$imageName);
        
        $docUpload = new Document();
        $docUpload->type = $request->type;
        $docUpload->type_id = $request->typeid;
        $docUpload->filename = $imageName;
        $docUpload->path = public_path('images/'.uniqid());
        $docUpload->save();
        return response()->json(['success'=>$imageName]);
    }
    public function delete($id)
    {
        $docs = Document::find($id);
        if(file_exists($docs->path)){
            @unlink($docs->path);
        }
        if($docs->delete()){
            $return = ['sonuc' => true];
        }else{
            $return = ['sonuc' => false];
        }
        return response()->json($return);
    }
}
