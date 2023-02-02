<?php

namespace App\Imports;

use App\Models\ChuyenNganhModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ChuyenNganhImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $rows)
    {
        // dd($rows);
        $data = [
            'chuyen_nganh' => $rows["chuyen_nganh"],
        ];
        // dd($data);
        ChuyenNganhModel::insert($data);
    }
}
