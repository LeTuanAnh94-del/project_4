<?php

namespace App\Exports;

use App\Models\PhieuMuonModel;
use Maatwebsite\Excel\Concerns\FromCollection;

class PhieuMuonExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $phieumuon = PhieuMuonModel::getAllPhieuMuonExcel();

        $cols = [
            "Mã Phiếu",
            "Tên Độc Giả",
            "Sách Mượn",
            "Ngày Mượn",
            "Hạn Trả",
        ];

        $column = (object) null;
        foreach ($cols as $key => $col) {
            $column->{$col} = $col;
        }
        return collect(array_merge([$column],$phieumuon));
    }
}
