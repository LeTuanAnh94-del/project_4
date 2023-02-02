<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ChuyenNganhModel extends Model
{
    protected $fillable = [];
    protected $table = "chuyen_nganh";
    use HasFactory;
    static function getAllCN($keywordCN)
    {
        if(empty($keywordCN))
        return DB::select("SELECT * FROM chuyen_nganh");
        else{
            return DB::table('chuyen_nganh')->select('*')->where('ten_CN','LIKE','%'.$keywordCN.'%')->get();
        }
    }

    static function addNewCN($ma_CN,$chuyen_nganh){
        return DB::insert("INSERT INTO chuyen_nganh VALUES(NULL,'$chuyen_nganh')");
    }

    static function getCN($ma_CN){
        $CNs =  DB::select("SELECT * FROM chuyen_nganh WHERE ma_CN = '$ma_CN'");
        if(count($CNs) == 0) return NULL;
        else return $CNs[0];
    }
    static function updateCN($ma_CN,$chuyen_nganh){
        try{
            DB::update("UPDATE chuyen_nganh SET ma_CN = '$ma_CN', chuyen_nganh = '$chuyen_nganh' WHERE ma_CN = '$ma_CN'");
        }catch (Exception $err){
            return false;
        }
        return true;
    }
    static function getAllChuyenNganhExcel(){
        return DB::select("SELECT * FROM chuyen_nganh");
    }
}
