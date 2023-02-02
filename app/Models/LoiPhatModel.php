<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LoiPhatModel extends Model
{
    protected $fillable = [];
    protected $table = "phat_loi";
    use HasFactory;
    static function getAllLoi($keywordloi)
    {
        if(empty($keywordloi))
        return DB::select("SELECT * FROM phat_loi");
        else{
            return DB::table('phat_loi')->select('*')->where('loi_phat','LIKE','%'.$keywordloi.'%')->get();
        }
    }
    static function addNewLoi($ma_Phat,$loi_phat,$muc_phat){
        return DB::insert("INSERT INTO phat_loi VALUES(NULL,'$loi_phat','$muc_phat')");
    }

    static function deleteLoiByID($ma_Phat){
        // return DB::delete("DELETE FROM tac_gia WHERE ma_TG = '$ma_TG'");
        try{
            DB::delete("DELETE FROM phat_loi WHERE ma_Phat = '$ma_Phat'");
            return true;
        }catch (Exception $err){
            return false;
        }
    }
    static function getLoi($ma_Phat){
        $lois =  DB::select("SELECT * FROM phat_loi WHERE ma_Phat = '$ma_Phat'");
        if(count($lois) == 0) return NULL;
        else return $lois[0];
    }
    static function updateLoi($ma_Phat,$loi_phat,$muc_phat){
        try{
            DB::update("UPDATE phat_loi SET ma_Phat = '$ma_Phat', loi_phat = '$loi_phat', muc_phat = '$muc_phat' WHERE ma_Phat = '$ma_Phat'");
        }catch (Exception $err){
            return false;
        }
        return true;
    }
    static function getAllLoiPhatExcel(){
        return DB::select("SELECT * FROM phat_loi");
    }
}
