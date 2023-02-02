<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DocGiaModel extends Model
{
    protected $fillable = [];
    protected $table = "doc_gia";
    protected $primaryKey = 'ma_DG';
    protected $columns = [
        "ma_DG",
        "ho_ten",
        "ngay_sinh",
        "gioi_tinh",
        "email",
        "lien_he",
        "dia_chi",
        "ngay_lam_the",
        "ngay_het_han"
    ];
    use HasFactory;
    static function getAllDocGia($keyworddocgia)
    {
        return DB::select("SELECT * FROM doc_gia ORDER BY ma_DG ASC");
    }
    static function addnewdocgia($ma_DG, $ho_ten, $ngay_sinh, $gioi_tinh, $email, $lien_he, $dia_chi, $ngay_lam_the, $ngay_het_han, $tinh_trang)
    {
        return DB::insert("INSERT INTO doc_gia VALUES(NULL,'$ho_ten','$ngay_sinh', $gioi_tinh, '$email','$lien_he','$dia_chi','$ngay_lam_the','$ngay_het_han', 0)");
    }
    static function deleteDocGiaByID($ma_DG)
    {
        try {
            DB::delete("DELETE FROM doc_gia WHERE ma_DG='$ma_DG'");
            return true;
        } catch (Exception $err) {
            return false;
        }
    }

    static function getDocGia($ma_DG)
    {
        // dd($ma_DG[0]);
        $docgias =  DB::select("SELECT * FROM doc_gia WHERE ma_DG = '$ma_DG[0]'");
        if (count($docgias) == 0) return NULL;
        else return $docgias[0];
    }
    static function updateDocGia($ma_DG, $ho_ten, $ngay_sinh, $gioi_tinh, $email, $lien_he, $dia_chi, $ngay_lam_the, $ngay_het_han)
    {
        try {
            DB::update(
                "UPDATE `doc_gia` SET `ho_ten` = ?, `ngay_sinh` = ?, `gioi_tinh` = ?, `email` = ? , `lien_he` = ?, `dia_chi` = ?, `ngay_lam_the` = ?, `ngay_het_han` = ? WHERE `ma_DG` = ?",
                [$ho_ten, $ngay_sinh, $gioi_tinh, $email, $lien_he, $dia_chi, $ngay_lam_the, $ngay_het_han, $ma_DG]
            );
        } catch (Exception $err) {
            return false;
        }
        return true;
    }
    static function chitietDocGia($ma_DG)
    {
        return DB::select("SELECT * FROM doc_gia WHERE ma_DG = '$ma_DG'");
    }
    static function getAllDocGiaExcel(){
        return DB::select("SELECT * FROM doc_gia");
    }
}
