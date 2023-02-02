<?php

namespace App\Exports;

use App\Models\DocGiaModel;
use Maatwebsite\Excel\Concerns\FromCollection;

class DocGiaExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $docgia = DocGiaModel::getAllDocGiaExcel();

        $cols = [
            "Mã Độc Giả",
            "Họ Tên",
            "Ngày Sinh",
            "Giới Tính",
            "Email",
            "Liên Hệ",
            "Địa Chỉ",
            "Ngày Làm Thẻ",
            "Ngày Hết Hạn",
        ];

        $column = (object) null;
        foreach ($cols as $key => $col) {
            $column->{$col} = $col;
        }
        return collect(array_merge([$column],$docgia));
    }
}
