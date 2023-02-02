<?php

namespace App\Exports;

use App\Models\TheLoaiModel;
use Maatwebsite\Excel\Concerns\FromCollection;

class TheLoaiExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $theloai = TheLoaiModel::getAllTheLoaiExcel();

        $cols = [
            "Mã Thể Loại",
            "Thể Loại",

        ];

        $column = (object) null;
        foreach ($cols as $key => $col) {
            $column->{$col} = $col;
        }
        return collect(array_merge([$column],$theloai));
    }
}
