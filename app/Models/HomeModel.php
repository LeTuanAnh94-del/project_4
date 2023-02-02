<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class HomeModel extends Model
{
    protected $table = "sach";
    use HasFactory;
    static function getAllSach($keywordsach)
    {
        return DB::select("SELECT * FROM sach");
    }

    static function getAllSachExport()
    {
        return DB::select("SELECT sach.ma_sach, sach.ten_sach, sach.noi_dung, sach.so_trang, sach.gia_tien, sach.so_luong, sach.ngay_nhap,
        the_loai.the_loai, nha_xuat_ban.nha_xuat_ban, chuyen_nganh.chuyen_nganh, tac_gia.ho_ten  FROM sach
        INNER JOIN nha_xuat_ban ON sach.ma_NXB = nha_xuat_ban.ma_NXB
            INNER JOIN sach_tg ON sach.ma_sach = sach_tg.ma_sach
            INNER JOIN tac_gia ON sach_tg.ma_TG = tac_gia.ma_TG
            INNER JOIN the_loai ON sach.ma_TL = the_loai.ma_TL
            INNER JOIN chuyen_nganh ON sach.ma_CN = chuyen_nganh.ma_CN");
    }

     static function getColumnName()
    {
        return DB::select("SELECT COLUMN_NAME as name
        FROM INFORMATION_SCHEMA.COLUMNS
        WHERE TABLE_NAME = N'sach' and TABLE_SCHEMA = N'project_4';");
    }


    static function addNewSach($ma_sach, $ten_sach, $image, $noi_dung, $so_trang, $gia_tien, $so_luong, $ngay_nhap, $ma_TL, $ma_NXB, $ma_CN, $tinh_trang)
    {
        try {
            DB::insert(
                "INSERT INTO `sach`(`ma_sach`, `ten_sach`,`image`, `noi_dung`, `so_trang`, `gia_tien`, `so_luong`, `ngay_nhap`, `ma_TL`, `ma_NXB`, `ma_CN`, `tinh_trang`)
            VALUES (?,?,?,?,?,?,?,?,?,?,?,0)",
                [NULL, $ten_sach,$image, $noi_dung, $so_trang, $gia_tien, $so_luong, $ngay_nhap, $ma_TL, $ma_NXB, $ma_CN, $tinh_trang]
            );
        } catch (Exception $err) {
            return false;
        }
        return true;
    }

    static function deletaSachById($ma_sach)
    {
        try{
            DB::delete("DELETE FROM sach WHERE ma_sach = '$ma_sach'");
            return true;
        }catch (Exception $err){
            return false;
        }

    }

    static function getSach($ma_sach)
    {
        $sachs = DB::select("SELECT * FROM sach WHERE ma_sach = '$ma_sach'");
        if (count($sachs) == 0) return NULL;
        else return $sachs[0];
    }
    static function sach($ma_sach)
    {
        $sachs = DB::select("SELECT * FROM sach WHERE ma_sach = '$ma_sach'");
        // if (count($sachs) == 0) return NULL;
        // else return $sachs[0];
        return $sachs[0];
    }

    static function updateSach($ma_sach, $ten_sach, $image, $noi_dung, $so_trang, $gia_tien, $so_luong, $ngay_nhap, $ma_TL, $ma_NXB, $ma_CN)
    {

        if($image == NULL){
            $sql = "UPDATE sach SET ten_sach = '$ten_sach', noi_dung = '$noi_dung', so_trang = '$so_trang', gia_tien = '$gia_tien', so_luong = '$so_luong', ngay_nhap = '$ngay_nhap',  ma_TL = '$ma_TL', ma_NXB = '$ma_NXB', ma_CN = '$ma_CN' WHERE ma_sach = '$ma_sach'";
        }
        else{
            $sql = "UPDATE sach SET ten_sach = '$ten_sach', image = '$image', noi_dung = '$noi_dung', so_trang = '$so_trang', gia_tien = '$gia_tien', so_luong = '$so_luong', ngay_nhap = '$ngay_nhap',  ma_TL = '$ma_TL', ma_NXB = '$ma_NXB', ma_CN = '$ma_CN' WHERE ma_sach = '$ma_sach'";

        }
        return DB::update($sql);

    }
    static function chontheloai(){
        return DB::select("SELECT * FROM the_loai ");
    }
    static function chitietSach($ma_sach){
        return DB::select("SELECT sach.ma_sach, sach.ten_sach, sach.noi_dung, sach.so_trang, sach.gia_tien, sach.so_luong, sach.ngay_nhap,
        the_loai.the_loai, nha_xuat_ban.nha_xuat_ban, chuyen_nganh.chuyen_nganh, tac_gia.ho_ten  FROM sach
        INNER JOIN nha_xuat_ban ON sach.ma_NXB = nha_xuat_ban.ma_NXB
            INNER JOIN sach_tg ON sach.ma_sach = sach_tg.ma_sach
            INNER JOIN tac_gia ON sach_tg.ma_TG = tac_gia.ma_TG
            INNER JOIN the_loai ON sach.ma_TL = the_loai.ma_TL
            INNER JOIN chuyen_nganh ON sach.ma_CN = chuyen_nganh.ma_CN
            WHERE ma_sach = '$ma_sach'");
    }
}
