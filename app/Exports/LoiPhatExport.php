<?php

namespace App\Exports;

use App\Models\LoiPhatModel;
use Maatwebsite\Excel\Concerns\FromCollection;

class LoiPhatExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $loiphat= LoiPhatModel::getAllLoiPhatExcel();

        $cols = [
            "Mã Lỗi",
            "Lỗi Phạt",
            "Mức Phạt",
        ];

        $column = (object) null;
        foreach ($cols as $key => $col) {
            $column->{$col} = $col;
        }
        return collect(array_merge([$column],$loiphat));
    }
}
