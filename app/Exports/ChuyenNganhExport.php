<?php

namespace App\Exports;

use App\Models\ChuyenNganhModel;
use Maatwebsite\Excel\Concerns\FromCollection;

class ChuyenNganhExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $chuyennganh = ChuyenNganhModel::getAllChuyenNganhExcel();

        $cols = [
            "Mã CN",
            "Chuyên Ngành",
        ];

        $column = (object) null;
        foreach ($cols as $key => $col) {
            $column->{$col} = $col;
        }
        return collect(array_merge([$column],$chuyennganh));
    }
}
