<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class sachdangmuonModel extends Model
{
    use HasFactory;
    static function getallchitiet(){
        return DB::select("SELECT * FROM phieu_muon_sach where tinh_trang IS NULL ");
    }
    static function getnumberdocgia(){
        return DB::select("SELECT * FROM doc_gia");
    }
    static function getnumbersach(){
        return DB::select("SELECT * FROM sach");
    }
    static function getnumberphieumuon(){
        return DB::select("SELECT * FROM phieu_muon");
    }
    static function getsumbook(){
        return DB::select("SELECT so_luong FROM sach");
    }
}
