<?php

namespace App\Http\Controllers;

use App\Exports\PhieuMuonExport;
use App\Models\DocGiaModel;
use App\Models\HomeModel;
use App\Models\LoiPhatModel;
use App\Models\PhieuMuonModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\Environment\Console;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class PhieuMuonController extends Controller
{
    function getAllPhieuMuon(Request $request){
        $ma_phieu = $request->input('ma_phieu');
        $keywordphieumuon = $request->input('keywordphieumuon','');
        $phieumuons = PhieuMuonModel::getAllPhieuMuon($keywordphieumuon);
        $sachs = HomeModel::getAllSach('');

        if(empty($keywordphieumuon)){
            $phieumuons = DB::table('phieu_muon')->select('*')
            ->join('doc_gia', 'phieu_muon.ma_DG', '=', 'doc_gia.ma_DG')
            ->orderBy('phieu_muon.ma_phieu', 'DESC')->paginate(6);
        }else{
            $phieumuons = DB::table('phieu_muon')->select('*')
            ->join('doc_gia', 'phieu_muon.ma_DG', '=', 'doc_gia.ma_DG')
            ->where('ho_ten', 'LIKE', '%'.$keywordphieumuon.'%')
            ->orWhere('ma_phieu', 'LIKE', '%'.$keywordphieumuon.'%')
            ->orderBy('phieu_muon.ma_phieu', 'DESC')->paginate(6);
        }
        $phieumuon_copys = DB::table("phieu_muon")->select('phieu_muon.ma_phieu', 'doc_gia.ho_ten', 'phieu_muon.ngay_muon', 'phieu_muon.han_tra', 'sach.ten_sach')
        ->join('doc_gia', 'phieu_muon.ma_DG', '=', 'doc_gia.ma_DG')
            ->join('phieu_muon_sach', 'phieu_muon.ma_phieu', '=', 'phieu_muon_sach.ma_phieu')
            ->join('sach', 'sach.ma_sach', '=', 'phieu_muon_sach.ma_sach')
            ->get();
        $phieumuonsachs = DB::table("phieu_muon_sach")->select('*')->get();
        // dd($phieumuonsachs);
        return view('phieumuon', compact('keywordphieumuon'))
        ->with('phieumuons', $phieumuons)
        ->with('phieumuon_copys', $phieumuon_copys)
        ->with('sachs', $sachs)
        ->with('phieumuonsachs', $phieumuonsachs);
    }

    function hiendocgia(){
        $docgias = PhieuMuonModel::hiendocgia();
        $sachs = HomeModel::getAllSach('');
        return view('themphieumuon')->with('docgias', $docgias)->with('sachs', $sachs);
    }
    function addphieumuon(Request $request){
        $ma_DG = $request->input('ma_DG');
        $ngay_muon = $request->input('ngay_muon');
        $han_tra = $request->input('han_tra');
        $ma_sach = $request->input('ma_sach');
        $phieumuon = (object) null;
        $phieumuon->ma_DG = $ma_DG;
        $phieumuon->ma_sach = $ma_sach;
        $docgia = DocGiaModel::getDocGia($ma_DG);
        $phieumuon->ho_ten = $docgia->ho_ten;
        // $sachs = HomeModel::sach($ma_sach);
        $sach = HomeModel::getSach($ma_sach[0]);
        $phieumuon->ten_sach = $sach->ten_sach;

        HomeModel::updateSach(
            $sach->ma_sach,
            $sach->ten_sach,
            $sach->image,
            $sach->noi_dung,
            $sach->so_trang,
            $sach->gia_tien,
            $sach->so_luong - 1,
            $sach->ngay_nhap,
            $sach->ma_TL,
            $sach->ma_NXB,
            $sach->ma_CN
        );

        $phieumuon->ngay_muon = $ngay_muon;
        $phieumuon->han_tra = $han_tra;
        $tinh_trang = $request->tinh_trang;

        $this -> validate($request,[
            'ma_sach' => 'required',
            'ma_DG' => 'required',
            'ngay_muon' => 'required',
            'han_tra' => 'required',
            'han_tra' => 'required|date|after_or_equal:tomorrow'
        ],[
            'ma_sach.required' => 'Vui lòng chọn Sách muốn mượn !',
            'ma_DG.required' => 'Vui lòng chọn Độc giả mượn sách !',
            'ngay_muon.required' => 'Vui lòng chọn ngày mượn !',
            'han_tra.required' => 'Vui lòng chọn hạn trả !',
            'han_tra.date' => 'Hạn trả không hợp lệ !',
            'han_tra.after_or_equal' => 'Hạn trả không hợp lệ !'
        ]);

        Mail::send('emails.check_order',['phieumuon'=> $phieumuon] , function($email) use($docgia){
            $email->subject('Thư viện học viện công nghệ BKACAD');
            $email->to($docgia->email);
        });

        $sachs = HomeModel::getAllSach('');
        $tong_tien = 0;
        foreach ($sachs as $sach) {
            foreach ($ma_sach as $ma_sach_child) {
                if ($sach->ma_sach == $ma_sach_child) {
                    $tong_tien += $sach->gia_tien;
                }
            }
        }
        $tong_tien = $tong_tien * 0.3;


        $rs = PhieuMuonModel::phieumuonmoi($ma_DG, $ngay_muon, $han_tra, $tong_tien);
        $lastRow = DB::table("phieu_muon")->orderBy('ma_phieu', 'desc')->first();
        for ($i = 0; $i < sizeof($ma_sach); $i++) {
            DB::table("phieu_muon_sach")->insert([
                'ma_sach' => $ma_sach[$i],
                'ma_phieu' => $lastRow->ma_phieu,
                // 'tinh_trang' => 0
            ]);
        }
        if($rs){
            return redirect('/phieumuon');
        }else{
            $ho_ten = '';
            $phieumuon = PhieuMuonModel::getAllPhieuMuon($ho_ten);
            $sach = HomeModel::getAllSach('');
            return view('themphieumuon', [
                'phieumuon'=> $phieumuon,
                'sach'=>$sach
            ])->with('err', 'Thêm thất bại');
        }
    }

    //trasach
    function getAllTraSach(Request $request){
        $ma_phieu = $request->input('ma_phieu');
        $keywordtrasach = $request->input('keywordtrasach','');
        $phieumuons = PhieuMuonModel::getAllPhieuMuon($keywordtrasach);
        $sachs = HomeModel::getAllSach('');



        if(empty($keywordtrasach)){
        $phieumuons = DB::table('phieu_muon')->select('*')
            ->join('doc_gia', 'phieu_muon.ma_DG', '=', 'doc_gia.ma_DG')
            ->orderBy('phieu_muon.ma_phieu', 'DESC')->paginate(10);

            // dd($phieumuons);
        }else{
        $phieumuons = DB::table("phieu_muon")->select('*')
        ->join('doc_gia', 'phieu_muon.ma_DG', '=', 'doc_gia.ma_DG')
            ->where('ho_ten', 'LIKE', '%'.$keywordtrasach.'%')
            ->orWhere('ma_phieu', 'LIKE', '%'.$keywordtrasach.'%')
            ->orderBy('phieu_muon.ma_phieu', 'DESC')->paginate(10);
        }
        $phieumuonsachs = DB::table("phieu_muon")->select('phieu_muon.ma_phieu','doc_gia.ho_ten', 'phat_loi.loi_phat','sach.ten_sach', 'phieu_muon_sach.ngay_tra')
        ->join('doc_gia', 'phieu_muon.ma_DG', '=', 'doc_gia.ma_DG')
            ->join('phieu_muon_sach', 'phieu_muon.ma_phieu', '=', 'phieu_muon_sach.ma_phieu')
            ->join('sach', 'sach.ma_sach', '=', 'phieu_muon_sach.ma_sach')
            ->join('phat_loi', 'phat_loi.ma_Phat', '=', 'phieu_muon_sach.ma_Phat')
            ->get();

        // dd($phieumuonsachs);
        return view('trasach', compact('keywordtrasach'))
        ->with('phieumuons', $phieumuons)
        ->with('sachs', $sachs)
        ->with('phieumuonsachs', $phieumuonsachs);
    }
    function showtrasach($ma_phieu){
        $tensach = '';
        $sachs = HomeModel::getAllSach($tensach);
        $loiphats = LoiPhatModel::getAllLoi('');
        $phieumuon = PhieuMuonModel::getphieumuon($ma_phieu);
        $phieutras = DB::table("phieu_muon")->select('phieu_muon_sach.ma_phieu', 'sach.ma_sach','sach.ten_sach', 'phieu_muon_sach.tinh_trang', 'phieu_muon_sach.ngay_tra')
            ->join('phieu_muon_sach', 'phieu_muon.ma_phieu', '=', 'phieu_muon_sach.ma_phieu')
            ->join('sach', 'sach.ma_sach', '=', 'phieu_muon_sach.ma_sach')
            // ->join('phat_loi', 'phat_loi.ma_Phat', '=', 'phieu_muon_sach.ma_Phat')
            ->where('phieu_muon.ma_phieu', $ma_phieu)
            ->get();

        $phieumuonsachs = DB::table("phieu_muon_sach")->select("ma_sach")->where("ma_phieu", $ma_phieu)->get();
        $valueSach = [];
        for ($i = 0; $i < sizeof($phieumuonsachs); $i++) {
            array_push($valueSach, $phieumuonsachs[$i]->ma_sach);
        }
        return view('themtrasach',
            [
            'sachs'=>$sachs,
            'loiphats'=>$loiphats,
            'valueSach'=>$valueSach,
            'phieumuon'=>$phieumuon,
            'phieutras'=>$phieutras
            ]
        );
    }
    function addtrasach(Request $request){
        $ma_phieu = $request->input('ma_phieu');
        $ngay_tra = $request->input('ngay_tra');
        $tien_phat = $request->input('tien_phat');
        $tinh_trang = $request->input('tinh_trang');
        $ma_Phat = $request->input('ma_Phat');
        $tra_sach = $request->input('tra_sach');
        // $ma_sach = $request->input('ma_sach');

        $tinh_trang = 1;
        $phat = 4;
        $tienPhat = 0;
        foreach($tra_sach as $ma_sach => $each){
            if(isset($ma_Phat[$ma_sach])){
                $phat = $ma_Phat[$ma_sach];
            }
            if(isset($tien_phat[$ma_sach])){
                $tienPhat = $tien_phat[$ma_sach];
            }
            PhieuMuonModel::sachmoi($ma_phieu,$ma_sach, $phat, $ngay_tra, $tinh_trang, $tienPhat);
        }
        // dd($ma_sach);

        $sach = HomeModel::getSach($ma_sach);
        HomeModel::updateSach(
            $sach->ma_sach,
            $sach->ten_sach,
            $sach->image,
            $sach->noi_dung,
            $sach->so_trang,
            $sach->gia_tien,
            $sach->so_luong + 1,
            $sach->ngay_nhap,
            $sach->ma_TL,
            $sach->ma_NXB,
            $sach->ma_CN
        );

        return redirect('/trasach');
    }
    public function export_phieumuon(){
        return Excel::download(new PhieuMuonExport, 'phieu_muon.xlsx');
    }
    public function chitietTraSach($ma_phieu){
        $chitiets = DB::table("phieu_muon")->select('phieu_muon.ma_phieu', 'phieu_muon.tong_tien', 'phat_loi.loi_phat', 'phat_loi.muc_phat','sach.ten_sach', 'phieu_muon_sach.ngay_tra',   'phieu_muon_sach.tien_phat', 'sach.image')
        ->join('phieu_muon_sach', 'phieu_muon.ma_phieu', '=', 'phieu_muon_sach.ma_phieu')
        ->join('sach', 'sach.ma_sach', '=', 'phieu_muon_sach.ma_sach')
        ->join('phat_loi', 'phat_loi.ma_Phat', '=', 'phieu_muon_sach.ma_Phat')
        ->where('phieu_muon.ma_phieu', $ma_phieu)
        ->get();

        return view('chitiettrasach')->with('chitiets', $chitiets);
    }

}
