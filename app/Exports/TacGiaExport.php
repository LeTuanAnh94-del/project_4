<?php

namespace App\Exports;

use App\Models\TacGiaModel;
use Maatwebsite\Excel\Concerns\FromCollection;

class TacGiaExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $tacgia = TacGiaModel::getAllTacGiaExcel();

        $cols = [
            "Mã Tác Giả",
            "Tên Tác Giả",
            "Địa Chỉ",
            "Liên Hệ",
        ];

        $column = (object) null;
        foreach ($cols as $key => $col) {
            $column->{$col} = $col;
        }
        return collect(array_merge([$column],$tacgia));
    }
}
