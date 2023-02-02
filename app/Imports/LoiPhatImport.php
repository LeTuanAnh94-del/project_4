<?php

namespace App\Imports;

use App\Models\LoiPhatModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LoiPhatImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $rows)
    {
        $data = [
            'loi_phat' => $rows['loi_phat'],
        ];
        // dd($data);
        LoiPhatModel::insert($data);
    }
}
