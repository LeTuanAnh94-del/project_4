<?php

namespace App\Imports;

use App\Models\DocGiaModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DocGiaImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $rows
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $rows)
    {
        // dd($rows);
        $data = [
            'ho_ten' => $rows["ho_ten"],
            'ngay_sinh' => date('Y-m-d', $rows["ngay_sinh"]),
            'gioi_tinh' => $rows['gioi_tinh'],
            'email' => $rows['email'],
            'lien_he' => $rows['lien_he'],
            'dia_chi' => $rows['dia_chi'],
            'ngay_lam_the' => date('Y-m-d', $rows["ngay_lam_the"]),
            'ngay_het_han' => date('Y-m-d', $rows["ngay_het_han"]),
        ];

        DocGiaModel::insert($data);
    }
}
