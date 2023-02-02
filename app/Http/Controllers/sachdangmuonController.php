<?php

namespace App\Http\Controllers;

use App\Models\Date;
use App\Models\sachdangmuonModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class sachdangmuonController extends Controller
{
    function getallchitiet(){
        $sosach = sachdangmuonModel::getsumbook();
        $phieumuons = sachdangmuonModel::getnumberphieumuon();
        $sachs = sachdangmuonModel::getnumbersach();
        $docgias = sachdangmuonModel::getnumberdocgia();
        $chitiets = sachdangmuonModel::getallchitiet();

        $post = DB::select('SELECT DATE(phieu_muon.ngay_muon) as ngay, SUM(phieu_muon.tong_tien) AS phimuon FROM phieu_muon
        INNER JOIN phieu_muon_sach ON phieu_muon.ma_phieu = phieu_muon_sach.ma_phieu
        INNER JOIN phat_loi ON phat_loi.ma_Phat = phieu_muon_sach.ma_Phat
        WHERE ( phieu_muon.ngay_muon >= DATE_ADD(NOW(), INTERVAL -30 DAY))
            GROUP BY DATE(phieu_muon.ngay_muon)');


        $post1 = DB::select('SELECT sach.ten_sach as ten, COUNT(doc_gia.ho_ten) as nguoimuon FROM phieu_muon
        INNER JOIN phieu_muon_sach ON phieu_muon.ma_phieu = phieu_muon_sach.ma_phieu
        INNER JOIN sach ON phieu_muon_sach.ma_sach = sach.ma_sach
        INNER JOIN doc_gia ON phieu_muon.ma_DG = doc_gia.ma_DG
        WHERE (phieu_muon.ngay_muon >= DATE_ADD(NOW(), INTERVAL -30 DAY))
        GROUP BY sach.ten_sach');

        $post2 = DB::select('SELECT DATE(phieu_muon_sach.ngay_tra) as ngaytra, SUM(phat_loi.muc_phat) as loiphat FROM phieu_muon
        INNER JOIN phieu_muon_sach ON phieu_muon.ma_phieu = phieu_muon_sach.ma_phieu
        INNER JOIN phat_loi ON phat_loi.ma_Phat = phieu_muon_sach.ma_Phat
        WHERE ( phieu_muon_sach.ngay_tra >= DATE_ADD(NOW(), INTERVAL -30 DAY))
            GROUP BY DATE(phieu_muon_sach.ngay_tra)');
        // dd($post);
        // dd($chitiets);
        return view('thong_ke.sachdangmuon')
        ->with('chitiets', $chitiets)
        ->with('docgias',$docgias)
        ->with('sachs',$sachs)
        ->with('phieumuons', $phieumuons)
        ->with('sosach',$sosach)
        ->with('data',$post1)
        ->with('data1', $post)
        ->with('data2', $post2);
    }
    function filter_by_date(Request $req){
        $sosach = sachdangmuonModel::getsumbook();
        $phieumuons = sachdangmuonModel::getnumberphieumuon();
        $sachs = sachdangmuonModel::getnumbersach();
        $docgias = sachdangmuonModel::getnumberdocgia();
        $chitiets = sachdangmuonModel::getallchitiet();

        $date = new Date();
        $date->fromDate = Date($req->from_date);

        $date->toDate = Date($req->to_date);
        $post = DB::select('SELECT DATE(phieu_muon.ngay_muon) as ngay, SUM(phieu_muon.tong_tien) AS phimuon FROM phieu_muon
        INNER JOIN phieu_muon_sach ON phieu_muon.ma_phieu = phieu_muon_sach.ma_phieu
        INNER JOIN phat_loi ON phat_loi.ma_Phat = phieu_muon_sach.ma_Phat
        WHERE DATE( phieu_muon.ngay_muon ) BETWEEN ? AND ?
            GROUP BY DATE(phieu_muon.ngay_muon)', [$date->fromDate, $date->toDate]);

        $post1 = DB::select('SELECT sach.ten_sach as ten, COUNT(doc_gia.ho_ten) as nguoimuon FROM phieu_muon
        INNER JOIN phieu_muon_sach ON phieu_muon.ma_phieu = phieu_muon_sach.ma_phieu
        INNER JOIN sach ON phieu_muon_sach.ma_sach = sach.ma_sach
        INNER JOIN doc_gia ON phieu_muon.ma_DG = doc_gia.ma_DG
        WHERE (ngay_muon >= DATE_ADD(NOW(), INTERVAL -30 DAY))
        GROUP BY sach.ten_sach');

        $post2 = DB::select('SELECT DATE(phieu_muon_sach.ngay_tra) as ngaytra, SUM(phat_loi.muc_phat) as loiphat FROM phieu_muon
        INNER JOIN phieu_muon_sach ON phieu_muon.ma_phieu = phieu_muon_sach.ma_phieu
        INNER JOIN phat_loi ON phat_loi.ma_Phat = phieu_muon_sach.ma_Phat
        WHERE DATE( phieu_muon_sach.ngay_tra ) BETWEEN ? AND ?
            GROUP BY DATE(phieu_muon_sach.ngay_tra)', [$date->fromDate, $date->toDate]);

        return view('thong_ke.sachdangmuon')
        ->with('chitiets', $chitiets)
        ->with('docgias',$docgias)
        ->with('sachs',$sachs)
        ->with('phieumuons', $phieumuons)
        ->with('sosach',$sosach)
        ->with('data',$post1)
        ->with('data1', $post)
        ->with('data2', $post2);
    }

}
