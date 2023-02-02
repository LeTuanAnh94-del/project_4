<?php

namespace App\Http\Controllers;

use App\Exports\ChuyenNganhExport;
use App\Imports\ChuyenNganhImport;
use App\Models\ChuyenNganhModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ChuyenNganhController extends Controller
{
    function getAllCN(Request $request){
        $keywordCN = $request->input('keywordCN','');
        $CNs = ChuyenNganhModel::getAllCN($keywordCN);
        if(empty($keywordCN)){
            $CNs = DB::table('chuyen_nganh')->select('*')->paginate(6);
        }else{
            $CNs = DB::table('chuyen_nganh')->select('*')->where('chuyen_nganh','LIKE','%'.$keywordCN.'%')->paginate(6);
        }
        return view('chuyennganh', compact('keywordCN'))->with('CNs', $CNs);
    }
    function themCN(Request $request){
        $ma_CN = $request->input('ma_CN');
        $chuyen_nganh = $request->input('chuyen_nganh');
        $this -> validate($request,[
            'chuyen_nganh' => 'required'
        ],[
            'chuyen_nganh.required' => 'Vui lòng nhập Tên Chuyên ngành !'
        ]);
        $rs = ChuyenNganhModel::addNewCN($ma_CN,$chuyen_nganh);
        if($rs==true){
            return redirect('/chuyennganh');
        }
        else{
            return "Thêm thất bại";
        }
    }

    function editCN($ma_CN){
        $CN = ChuyenNganhModel::getCN($ma_CN);
        return view('suaCN', ['CN'=>$CN]);
    }
    function processUpdateCN(Request $request, $ma_CN){
        $chuyen_nganh = $request->input('chuyen_nganh');
        $this -> validate($request,[
            'chuyen_nganh' => 'required'
        ],[
            'chuyen_nganh.required' => 'Vui lòng nhập Tên Chuyên ngành !'
        ]);

        $rs = ChuyenNganhModel::updateCN($ma_CN,$chuyen_nganh);
        if($rs){
            return redirect('/chuyennganh');
        }
        else{
            return "Cập nhật thất bại !";
        }
    }
    public function export_chuyennganh(){
        return Excel::download(new ChuyenNganhExport, 'chuyen_nganh.xlsx');
    }
    public function importFormChuyenNganh(){
        return view('import-form-chuyennganh');
    }
    public function import_chuyennganh(Request $request){
        $request->validate([
            'file' => 'required|max:10000|mimes:xlsx,xls',
        ]);

        $path = $request->file('file')->getRealPath();

        Excel::import(new ChuyenNganhImport, $path);
        return redirect('/chuyennganh');
    }
}
