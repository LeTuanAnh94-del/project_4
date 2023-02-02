<?php

namespace App\Imports;

use App\Models\TheLoaiModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TheLoaiImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $rows)
    {
        $data = [
            'the_loai' => $rows["the_loai"],
        ];
        // dd($data);
        TheLoaiModel::insert($data);
    }
}
