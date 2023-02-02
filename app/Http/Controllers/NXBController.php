<?php

namespace App\Http\Controllers;

use App\Exports\NXBExport;
use App\Imports\NXBImport;
use App\Models\NXBModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use SebastianBergmann\Environment\Console;

class NXBController extends Controller
{
    //
    function getAllNXB(Request $request){
        $keywordNXB = $request->input('keywordNXB','');
        $NXBs = NXBModel::getAllNXB($keywordNXB);
        if(empty($keywordNXB)){
            $NXBs = DB::table('nha_xuat_ban')->select('*')->paginate(6);
        }else{
            $NXBs = DB::table('nha_xuat_ban')->select('*')->where('nha_xuat_ban', 'LIKE', '%'.$keywordNXB.'%')->paginate(6);
        }
        return view('NXB', compact('keywordNXB'), ['NXBs'=>$NXBs]);
    }
    function themNXB(Request $request){
        //Lấy thông tin người dùng gửi lên
        $ma_NXB = $request->input('ma_NXB');
        $nha_xuat_ban = $request->input('nha_xuat_ban');
        $dia_chi = $request->input('dia_chi');
        $lien_he = $request->input('lien_he');
        $this -> validate($request,[
            'nha_xuat_ban' => 'required',
            'dia_chi' => 'required',
            'lien_he' => 'required|unique:nha_xuat_ban'
        ],[

            'nha_xuat_ban.required' => 'Vui lòng nhập Nhà Xuất Bản !',
            'dia_chi.required' => 'Vui lòng nhập địa chỉ Nhà Xuất Bản !',
            'lien_he.required' => 'Vui lòng nhập số điện thoại liên hệ !',
            'lien_he.unique' => 'Liên hệ đã tồn tại !',
        ]);
        //Gửi về model xử lý
        $rs = NXBModel::addnewNXB($ma_NXB,$nha_xuat_ban,$dia_chi,$lien_he);
        if($rs==true){
            //Thêm thành công trả về list
            return redirect('/NXB');
        }
        else{
            //Tạo thêm 1 trang hiển thị lỗi
            return "Thêm thất bại";
        }
    }

    function editNXB($ma_NXB){
        //Gọi vào model để lấy dữ liệu
        $NXB = NXBModel::getNXB($ma_NXB);
        //Trả về view
        return view('suaNXB', ['NXB'=>$NXB]);
    }
    function processUpdateNXB(Request $request, $ma_NXB){
        //Lấy dữ liệu mới
        $nha_xuat_ban = $request->input('nha_xuat_ban');
        $lien_he = $request->input('lien_he');
        $dia_chi = $request->input('dia_chi');
        $this -> validate($request,[
            'nha_xuat_ban' => 'required',
            'dia_chi' => 'required',
            'lien_he' => 'required|unique:nha_xuat_ban'
        ],[

            'nha_xuat_ban.required' => 'Vui lòng nhập Nhà Xuất Bản !',
            'dia_chi.required' => 'Vui lòng nhập địa chỉ Nhà Xuất Bản !',
            'lien_he.required' => 'Vui lòng nhập số điện thoại liên hệ !',
            'lien_he.unique' => 'Liên hệ đã tồn tại !',
        ]);
        //Gọi đến model
        $rs = NXBModel::updateNXB($ma_NXB,$nha_xuat_ban,$dia_chi,$lien_he);
        if($rs){
            return redirect('/NXB');
        }
        else{
            return "Cập nhật thất bại !";

        }
    }
    public function export_NXB(){
        return Excel::download(new NXBExport, 'NXB.xlsx');
    }
    public function importFormNXB(){
        return view('import-form-nhaxuatban');
    }
    public function import_nhaxuatban(Request $request){
        $request->validate([
            'file' => 'required|max:10000|mimes:xlsx,xls',
        ]);

        $path = $request->file('file')->getRealPath();

        Excel::import(new NXBImport, $path);
        return redirect('/NXB');
    }
}
