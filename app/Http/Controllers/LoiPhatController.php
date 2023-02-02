<?php

namespace App\Http\Controllers;

use App\Exports\LoiPhatExport;
use App\Imports\LoiPhatImport;
use App\Models\LoiPhatModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class LoiPhatController extends Controller
{
    function getAllLoi(Request $request){
        $keywordloi = $request->input('keywordloi','');
        $lois = LoiPhatModel::getAllLoi($keywordloi);
        if(empty($keywordloi)){
            $lois = DB::table('phat_loi')->select('*')->paginate(6);
        }else{
            $lois = DB::table('phat_loi')->select('*')->where('loi_phat','LIKE','%'.$keywordloi.'%')->paginate(6);
        }
        return view('loiphat', compact('keywordloi'))->with('lois', $lois);
    }
    function themLoi(Request $request){
        $ma_Phat = $request->input('ma_Phat');
        $loi_phat = $request->input('loi_phat');
        $muc_phat = $request->input('muc_phat');
        $this -> validate($request,[
            'loi_phat' => 'required',
            'muc_phat' => 'required',
        ],[
            'loi_phat.required' => 'Vui lòng nhập lỗi phạt !',
        ]);

        $rs = LoiPhatModel::addNewLoi($ma_Phat,$loi_phat,$muc_phat);
        if($rs==true){
            return redirect('/loiphat');
        }
        else{
            return "Thêm thất bại";
        }
    }

    function editLoi($ma_Phat){
        $loi = LoiPhatModel::getLoi($ma_Phat);
        return view('sualoi', ['loi'=>$loi]);
    }
    function processUpdateLoi(Request $request, $ma_Phat){
        $muc_phat = $request->input('muc_phat');
        $loi_phat = $request->input('loi_phat');
        $this -> validate($request,[
            'loi_phat' => 'required',
            'muc_phat' => 'required',
        ],[
            'loi_phat.required' => 'Vui lòng nhập lỗi phạt !',
        ]);

        $rs = LoiPhatModel::updateLoi($ma_Phat,$loi_phat,$muc_phat);
        if($rs){
            return redirect('/loiphat');
        }
        else{
            return "Cập nhật thất bại !";
        }
    }
    public function export_phatloi(){
        return Excel::download(new LoiPhatExport, 'loi_phat.xlsx');
    }

    public function importFormLoiPhat(){
        return view('import-form-loiphat');
    }
    public function import_loiphat(Request $request){
        $request->validate([
            'file' => 'required|max:10000|mimes:xlsx,xls',
        ]);

        $path = $request->file('file')->getRealPath();

        Excel::import(new LoiPhatImport, $path);
        return redirect('/loiphat');
    }
}
