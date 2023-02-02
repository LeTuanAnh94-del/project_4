<?php

namespace App\Http\Controllers;

use App\Exports\TacGiaExport;
use App\Imports\TacGiaImport;
use App\Models\TacGiaModel;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use SebastianBergmann\Environment\Console;

class TacGiaController extends Controller
{
    function getAllTacGia(Request $request){
        $keywordTacGia = $request->input('keywordTacGia','');
        $tacgias = TacGiaModel::getAllTacGia($keywordTacGia);
        if(empty($keywordTacGia)){
            $tacgias = DB::table('tac_gia')->select('*')->paginate(6);
        }else{
            $tacgias = DB::table('tac_gia')->select('*')->where('ho_ten','LIKE','$'.$keywordTacGia.'%')->paginate(6);
        }
        return view('tacgia', compact('keywordTacGia'))->with('tacgias', $tacgias);
    }
    function themTacGia(Request $request){
        $ma_TG = $request->input('ma_TG');
        $ho_ten = $request->input('ho_ten');
        $this -> validate($request,[
            'ho_ten' => 'required',
        ],[
            'ho_ten.required' => 'Vui lòng nhập Tên Tác giả!',
        ]);

        $rs = TacGiaModel::addNewTacGia($ma_TG, $ho_ten);
        if($rs==true){
            return redirect('/tacgia');
        }
        else{
            return "Thêm thất bại";
        }
    }

    function editTacGia($ma_TG){
        $tacgia = TacGiaModel::getTacGia($ma_TG);
        return view('suatacgia', ['tacgia'=>$tacgia]);
    }
    function processUpdateTacGia(Request $request, $ma_TG){
        $ho_ten = $request->input('ho_ten');
        $this -> validate($request,[
            'ho_ten' => 'required',
        ],[
            'ho_ten.required' => 'Vui lòng nhập Tên Tác giả!',
        ]);

        $rs = TacGiaModel::updateTacGia($ma_TG,$ho_ten);
        if($rs){
            return redirect('/tacgia');
        }
        else{
            return "Cập nhật thất bại !";
        }
    }
    public function export_tacgia(){
        return Excel::download(new TacGiaExport, 'tac_gia.xlsx');
    }
    public function importFormTacGia(){
        return view('import-form-tacgia');
    }
    public function import_tacgia(Request $request){
        $request->validate([
            'file' => 'required|max:10000|mimes:xlsx,xls',
        ]);

        $path = $request->file('file')->getRealPath();

        Excel::import(new TacGiaImport, $path);
        return redirect('/tacgia');
    }
}
