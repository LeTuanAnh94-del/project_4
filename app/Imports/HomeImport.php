<?php

namespace App\Imports;

use App\Models\HomeModel;
use Maatwebsite\Excel\Concerns\ToModel;

class HomeImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new HomeModel([
            "ten_sach" => $row['ten_sach'],
            "noi_dung" => $row['noi_dung'],
            "so_trang" => $row['so_trang'],
            "gia_tien" => $row['gia_tien'],
            "so_luong" => $row['so_luong'],
            "ngay_nhap" => $row['ngay_nhap'],
            "ma_TL" => $row['ma_TL'],
            "ma_NXB" => $row['ma_CN'],
        ]);
    }
}
