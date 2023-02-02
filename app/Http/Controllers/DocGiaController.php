<?php

namespace App\Http\Controllers;

use App\Exports\DocGiaExport;
use App\Models\DocGiaModel;
use App\Models\HomeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DocGiaImport;
use validator;


class DocGiaController extends Controller
{

	function getAllDocGia(Request $request){
        $keyworddocgia = $request->input('keyworddocgia','');
        $docgias =DocGiaModel::getAllDocGia($keyworddocgia);
        if(empty($keyworddocgia)){
            $docgias = DB:: table('doc_gia')->select('*')->orderBy('ma_DG','DESC')->paginate(6);
        }else{
            $docgias = DB:: table('doc_gia')->select('*')->where('ho_ten','LIKE','%'.$keyworddocgia.'%')->orderBy('ngay_sinh','DESC')->paginate(6);
        }
        return view('docgia', compact('keyworddocgia'), ['docgias'=>$docgias]);
    }

    function themdocgia(Request $request){
        $ma_DG = $request->ma_DG;
        $ho_ten = $request->ho_ten;
        $ngay_sinh = $request->ngay_sinh;
        $gioi_tinh = $request->gioi_tinh;
        $email = $request->email;
        $lien_he = $request->lien_he;
        $dia_chi = $request->dia_chi;
        $ngay_lam_the = $request->ngay_lam_the;
        $ngay_het_han = $request->ngay_het_han;
        $tinh_trang = $request->tinh_trang;
        $this -> validate($request,[
            'ho_ten' => 'required',
            'email' => 'required|unique:doc_gia',
            'ngay_sinh' => 'required',
            'dia_chi' => 'required',
            'ngay_lam_the' => 'required',
            'ngay_het_han' => 'required',
            'lien_he' => 'required|unique:doc_gia',
            'gioi_tinh' => 'required',
        ],[
            'ho_ten.required' => 'Vui lòng nhập Tên độc giả !',
            'email.required' => 'Vui lòng nhập Email của độc giả !',
            'email.unique' => 'Email đã tồn tại !',
            'ngay_sinh.required' => 'Vui lòng chọn Ngày sinh !',
            'dia_chi.required' => 'Vui lòng nhập Địa chỉ !',
            'ngay_lam_the.required' => 'Vui lòng chọn Ngày làm thẻ !',
            'ngay_het_han.required' => 'Vui lòng chọn Ngày hết hạn thẻ !',
            'lien_he.required' => 'Vui lòng nhập Liên hệ của độc giả !',
            'lien_he.unique' => 'Liên hệ đã tồn tại !',
            'gioi_tinh.required' => 'Vui lòng chọn Giới tính !',
        ]);
        $rs = DocGiaModel::addnewdocgia($ma_DG, $ho_ten, $ngay_sinh, $gioi_tinh, $email, $lien_he, $dia_chi, $ngay_lam_the, $ngay_het_han, $tinh_trang);
        if($rs==true){
            return redirect('/docgia');
        }
        else{
            return "Thêm thất bại";
        }
    }
    public function status_update_docgia($ma_DG){
        $docgias = DB::table('doc_gia')->select('tinh_trang')->where('ma_DG', '=', $ma_DG)->first();

        if($docgias->tinh_trang == '1'){
            $tinh_trang = '0';
        }else{
            $tinh_trang = '1';
        }

        $valueDG = array('tinh_trang' => $tinh_trang);
        DB::table('doc_gia')->where('ma_DG', $ma_DG)->update($valueDG);
        return redirect('/docgia');
    }

    function editDocGia($ma_DG){
        $docgia = DocGiaModel::getDocGia($ma_DG);
        return view('suadocgia', ['docgia'=>$docgia]);
    }
    function processUpdateDocGia(Request $request){
        $ma_DG = $request->ma_DG;
        $ho_ten = $request->ho_ten;
        $ngay_sinh = $request->ngay_sinh;
        $gioi_tinh = $request->gioi_tinh;
        $email = $request->email;
        $lien_he = $request->lien_he;
        $dia_chi = $request->dia_chi;
        $ngay_lam_the = $request->ngay_lam_the;
        $ngay_het_han = $request->ngay_het_han;
        $tinh_trang = $request->tinh_trang;
        $this -> validate($request,[
            'ho_ten' => 'required',
            'email' => 'required|unique:doc_gia',
            'ngay_sinh' => 'required',
            'dia_chi' => 'required',
            'ngay_lam_the' => 'required',
            'ngay_het_han' => 'required',
            'lien_he' => 'required|unique:doc_gia',
            'gioi_tinh' => 'required',
        ],[
            'ho_ten.required' => 'Vui lòng nhập Tên độc giả !',
            'email.required' => 'Vui lòng nhập Email của độc giả !',
            'email.unique' => 'Email đã tồn tại !',
            'ngay_sinh.required' => 'Vui lòng chọn Ngày sinh !',
            'dia_chi.required' => 'Vui lòng nhập Địa chỉ !',
            'ngay_lam_the.required' => 'Vui lòng chọn Ngày làm thẻ !',
            'ngay_het_han.required' => 'Vui lòng chọn Ngày hết hạn thẻ !',
            'lien_he.required' => 'Vui lòng nhập Liên hệ của độc giả !',
            'lien_he.unique' => 'Liên hệ đã tồn tại !',
            'gioi_tinh.required' => 'Vui lòng chọn Giới tính !',
        ]);

        $rs = DocGiaModel::updateDocGia($ma_DG, $ho_ten, $ngay_sinh, $gioi_tinh, $email, $lien_he, $dia_chi, $ngay_lam_the, $ngay_het_han, $tinh_trang);
        if($rs){
            $chitiets = DocGiaModel::chitietDocGia($ma_DG);
            return view('chitietdocgia')->with('chitiets', $chitiets);
        }
        else{
            return "Cập nhật thất bại !";
        }
    }
    function chitietDocGia($ma_DG){
        $chitiets = DocGiaModel::chitietDocGia($ma_DG);
        return view('chitietdocgia')->with('chitiets', $chitiets);
    }

    public function export_docgia(){
        return Excel::download(new DocGiaExport, 'doc_gia.xlsx');
    }
    public function importFormDocGia(){
        return view('import-form-docgia');
    }
    public function import_docgia(Request $request){
        $request->validate([
            'file' => 'required|max:10000|mimes:xlsx,xls',
        ]);

        $path = $request->file('file')->getRealPath();

        Excel::import(new DocGiaImport, $path);
        return view('/docgia');
    }
}
