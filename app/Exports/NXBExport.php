<?php

namespace App\Exports;

use App\Models\NXBModel;
use Maatwebsite\Excel\Concerns\FromCollection;

class NXBExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $NXB = NXBModel::getAllNXBExcel();

        $cols = [
            "Mã NXB",
            "Nhà Xuất Bản",
            "Địa Chỉ",
            "Liên Hệ",
        ];

        $column = (object) null;
        foreach ($cols as $key => $col) {
            $column->{$col} = $col;
        }
        return collect(array_merge([$column],$NXB));
    }
}
