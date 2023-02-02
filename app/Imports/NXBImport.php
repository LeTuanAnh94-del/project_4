<?php

namespace App\Imports;

use App\Models\NXBModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class NXBImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $rows)
    {
        $data = [
            'nha_xuat_ban' => $rows['nha_xuat_ban'],
            'dia_chi' => $rows['dia_chi'],
            'lien_he' => $rows['lien_he'],
        ];
        // dd($data);
        NXBModel::insert($data);
    }
}
