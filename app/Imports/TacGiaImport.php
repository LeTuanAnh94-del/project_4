<?php

namespace App\Imports;

use App\Models\TacGiaModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TacGiaImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $rows)
    {
        $data = [
            'ho_ten' => $rows["ho_ten"],
            // 'dia_chi' => $rows['dia_chi'],
            // 'lien_he' => $rows['lien_he'],
        ];
        // dd($data);
        TacGiaModel::insert($data);
    }
}
