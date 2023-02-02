<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TheLoaiModel extends Model
{
    protected $fillable = [];
    protected $table = "the_loai";
    use HasFactory;
    static function getAllTheLoai($keywordtheloai){
        // dd($keyword);
        if(empty($keywordtheloai))
        return DB::select("SELECT * FROM the_loai");
        else{
            return DB::table('the_loai')->select('*')->where('the_loai','LIKE','%'.$keywordtheloai.'%')->get();
        }

    }
    static function addNewTheLoai($ma_TL,$the_loai){
        return DB::insert("INSERT INTO the_loai VALUES(NULL,'$the_loai')");
    }
    static function deleteTheLoaiByID($ma_TL){
        return DB::delete("DELETE FROM the_loai WHERE ma_TL = '$ma_TL'");
    }
    static function getTheLoai($ma_TL){
        $theloais =  DB::select("SELECT * FROM the_loai WHERE ma_TL = '$ma_TL'");
        if(count($theloais) == 0) return NULL;
        else return $theloais[0];
    }
    static function updateTheLoai($ma_TL,$the_loai){
        try{
            DB::update("UPDATE the_loai SET ma_TL = '$ma_TL', the_loai = '$the_loai' WHERE ma_TL = '$ma_TL'");
        }catch (Exception $err){
            return false;
        }
        return true;
    }
    static function getAllTheLoaiExcel(){
        return DB::select("SELECT * FROM the_loai");
    }
}
