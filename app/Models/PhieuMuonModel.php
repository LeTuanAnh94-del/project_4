<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PhieuMuonModel extends Model
{
    protected $table = 'phieu_muon';
    use HasFactory;
    static function sachmoi($ma_phieu,$ma_sach, $ma_phat, $ngay_tra,$tinh_trang, $tien_phat)
    {
        // dd($ma_Phat, $tien_phat);


            $sql = "UPDATE phieu_muon_sach SET ma_phat = '$ma_phat', ngay_tra = '$ngay_tra', tinh_trang = '1', tien_phat = '$tien_phat' WHERE ma_sach = '$ma_sach' AND ma_phieu = '$ma_phieu'";

        // dd($sql);
        return DB::update($sql);

        // return DB::update("UPDATE phieu_muon_sach SET  ma_Phat = '$ma_Phat', ngay_tra = '$ngay_tra', tinh_trang = '$tinh_trang', tien_phat = '$tien_phat' WHERE ma_sach = '$ma_sach'");
    }
    static function getAllPhieuMuon($keywordphieumuon)
    {
        return DB::table('phieu_muon')->join('doc_gia', 'phieu_muon.ma_DG', '=', 'doc_gia.ma_DG')->select('*')->where('ho_ten', 'LIKE', '%' . $keywordphieumuon . '%')->orderBy('ma_phieu', 'DESC')->get();
    }
    static function chiTietPhieuMuon($ma_phieu)
    {
        return DB::select("SELECT * FROM phieu_muon_chi_tiet I
        NNER JOIN sach ON phieu_muon_chi_tiet.ma_sach = sach.ma_sach WHERE ma_phieu = '$ma_phieu'");
    }
    static function hiendocgia()
    {
        return DB::select("SELECT * FROM doc_gia");
    }
    static function phieumuonmoi($ma_DG, $ngay_muon, $han_tra, $tong_tien)
    {
        // return DB::insert("INSERT INTO phieu_muon VALUES(null, '$ma_DG', '$ngay_muon', '$han_tra')");

        try {
            return DB::table('phieu_muon')->insert([
                // 'ma_phieu' => null,
                'ma_DG' => $ma_DG,
                'ngay_muon' => $ngay_muon,
                'han_tra' => $han_tra,
                'tong_tien' => $tong_tien
            ]);

            // DB::insert(
            //     "INSERT INTO `phieu_muon`(`ma_phieu`, `ma_DG`, `ngay_muon`, `han_tra`)
            // VALUES (?,?,?,?)",
            //     [$ma_phieu, $ma_DG, $ngay_muon, $han_tra]
            // );
        } catch (Exception $err) {
            return false;
        }
        return true;
    }
    static function getphieumuon($ma_phieu)
    {
        $phieumuons =  DB::select("SELECT * FROM phieu_muon WHERE ma_phieu = '$ma_phieu'");
        if (count($phieumuons) == 0) return NULL;
        else return $phieumuons[0];
    }

    // static function phieumuon($ma_phieu)
    // {
    //     $phieumuons =  DB::select("SELECT * FROM phieu_muon WHERE ma_phieu = '$ma_phieu'");
    //     return $phieumuons;
    // }
    static function updatephieumuon($ma_phieu, $ma_DG, $ngay_muon, $han_tra)
    {
        return DB::update("UPDATE phieu_muon SET ma_phieu = '$ma_phieu', ma_DG = '$ma_DG', ngay_muon = '$ngay_muon', han_tra='$han_tra' WHERE ma_phieu = '$ma_phieu'");
    }
    static function getchitiet($ma_phieu, $ma_sach)
    {
        $chitiets =  DB::select("SELECT * FROM phieu_muon_chi_tiet WHERE ma_sach = '$ma_sach' AND ma_phieu = '$ma_phieu'");
        return $chitiets[0];
    }
    static function updatedchitiet($ma_phieu, $ma_sach, $ngay_tra, $tinh_trang)
    {
        return DB::update("UPDATE phieu_muon_chi_tiet SET ngay_tra = '$ngay_tra', tinh_trang='$tinh_trang' WHERE ma_sach = '$ma_sach'");
    }
    static function getmaphieu($ma_phieu)
    {
        return DB::select("SELECT * FROM phieu_muon_chi_tiet WHERE ma_phieu = '$ma_phieu'");
    }

    static function getnamebook()
    {
        return DB::select("SELECT * FROM sach");
    }
    static function getAllPhieuMuonExcel(){
        return DB::select("SELECT phieu_muon.ma_phieu, doc_gia.ho_ten, sach.ten_sach, phieu_muon.ngay_muon, phieu_muon.han_tra FROM phieu_muon
        INNER JOIN doc_gia ON phieu_muon.ma_DG = doc_gia.ma_DG
        INNER JOIN phieu_muon_sach ON phieu_muon.ma_phieu = phieu_muon_sach.ma_phieu INNER JOIN sach ON phieu_muon_sach.ma_sach = sach.ma_sach
        ");
    }
    static function getQuantity($ma_sach){
        return DB::select("SELECT so_luong FROM sach WHERE ma_sach = '$ma_sach'");
    }
}
