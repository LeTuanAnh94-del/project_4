<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class NXBModel extends Model
{
    protected $fillable = [];
    protected $table = "nha_xuat_ban";
    use HasFactory;
    static function getAllNXB($keywordNXB){
        // dd($keyword);
        if(empty($keywordNXB)) return DB::select('select * from nha_xuat_ban ');
        else{
            return DB::table('nha_xuat_ban')->select('*')->where('nha_xuat_ban','LIKE','%'.$keywordNXB.'%')->get();
        }

    }

    static function addnewNXB($ma_NXB,$nha_xuat_ban,$dia_chi,$lien_he){
        return DB::insert("INSERT INTO nha_xuat_ban VALUES(NULL,'$nha_xuat_ban','$dia_chi','$lien_he')");
    }
    static function deleteNXBByID($ma_NXB){
        return DB::delete("DELETE FROM nha_xuat_ban WHERE ma_NXB = '$ma_NXB'");
    }
    static function getNXB($ma_NXB){
        $NXBs =  DB::select("SELECT * FROM nha_xuat_ban WHERE ma_NXB = '$ma_NXB'");
        if(count($NXBs) == 0) return NULL;
        else return $NXBs[0];
    }
    static function updateNXB($ma_NXB,$nha_xuat_ban,$dia_chi,$lien_he){
        try{
            DB::update("UPDATE nha_xuat_ban SET ma_NXB = '$ma_NXB', nha_xuat_ban = '$nha_xuat_ban', dia_chi = '$dia_chi', lien_he = '$lien_he' WHERE ma_NXB = '$ma_NXB'");
        }catch (Exception $err){
            return false;
        }
        return true;
    }
    static function getAllNXBExcel(){
        return DB::select("SELECT * FROM nha_xuat_ban");
    }
}
