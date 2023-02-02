<?php

namespace App\Http\Controllers;

use App\Exports\TheLoaiExport;
use App\Imports\TheLoaiImport;
use App\Models\TheLoaiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class TheLoaiController extends Controller
{

	function getAllTheLoai(Request $request){
        $keywordTheLoai = $request->input('keywordTheLoai','');
        $theloais =TheLoaiModel::getAllTheLoai($keywordTheLoai);
        if(empty($keywordTheLoai)){
            $theloais = DB::table('the_loai')->select('*')->paginate(6);
        }else{
            $theloais = DB::table('the_loai')->select('*')->where('the_loai', 'LIKE', '%'.$keywordTheLoai.'%')->paginate(6);
        }
        return view('theloai', compact('keywordTheLoai'), ['theloais'=>$theloais]);
    }
    function themTheLoai(Request $request){
        $ma_TL = $request->ma_TL;
        $the_loai = $request->the_loai;
        $this -> validate($request,[
            'the_loai' => 'required',
        ],[
            'the_loai.required' => 'Vui lòng nhập Thể Loại !',
        ]);

        $rs = TheLoaiModel::addNewTheLoai($ma_TL,$the_loai);
        if($rs==true){
            return redirect('/theloai');
        }
        else{
            return "Thêm thất bại";
        }
    }

    function editTheloai($ma_TL){
        $theloai = TheLoaiModel::getTheLoai($ma_TL);
        return view('suatheloai', ['theloai'=>$theloai]);
    }
    function processUpdateTheLoai(Request $request, $ma_TL){
        $the_loai = $request->input('the_loai');
        $this -> validate($request,[
            'the_loai' => 'required',
        ],[
            'the_loai.required' => 'Vui lòng nhập Thể Loại !',
        ]);

        $rs = TheLoaiModel::updateTheLoai($ma_TL,$the_loai);
        if($rs){
            return redirect('/theloai');
        }
        else{
            return "Cập nhật thất bại";
        }
    }
    public function export_theloai(){
        return Excel::download(new TheLoaiExport, 'the_loai.xlsx');
    }
    public function importFormTheLoai(){
        return view('import-form-theloai');
    }
    public function import_theloai(Request $request){
        $request->validate([
            'file' => 'required|max:10000|mimes:xlsx,xls',
        ]);

        $path = $request->file('file')->getRealPath();

        Excel::import(new TheLoaiImport, $path);
        return redirect('/theloai');
    }
}
