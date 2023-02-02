<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TacGiaModel extends Model
{
    protected $fillable = [];
    protected $table = "tac_gia";
    use HasFactory;
    static function getAllTacGia($keywordTacGia)
    {
        if(empty($keywordTacGia))
        return DB::select("SELECT * FROM tac_gia");
        else{
            return DB::table('tac_gia')->select('*')->where('ho_ten','LIKE','%'.$keywordTacGia.'%')->get();
        }
    }

    static function addNewTacGia($ma_TG, $ho_ten){
        return DB::insert("INSERT INTO tac_gia VALUES(NULL,'$ho_ten')");
    }

    static function deleteTacGiaByID($ma_TG){
        // return DB::delete("DELETE FROM tac_gia WHERE ma_TG = '$ma_TG'");
        try{
            DB::delete("DELETE FROM tac_gia WHERE ma_TG = '$ma_TG'");
            return true;
        }catch (Exception $err){
            return false;
        }
    }
    static function getTacGia($ma_TG){
        $tacgias =  DB::select("SELECT * FROM tac_gia WHERE ma_TG = '$ma_TG'");
        if(count($tacgias) == 0) return NULL;
        else return $tacgias[0];
    }
    static function updateTacGia($ma_TG,$ho_ten){
        try{
            DB::update("UPDATE tac_gia SET ma_TG = '$ma_TG', ho_ten = '$ho_ten' WHERE ma_TG = '$ma_TG'");
        }catch (Exception $err){
            return false;
        }
        return true;
    }
    static function getAllTacGiaExcel(){
        return DB::select("SELECT * FROM tac_gia");
    }
}
