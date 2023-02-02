<?php

namespace App\Exports;

use App\Models\HomeModel;
use Maatwebsite\Excel\Concerns\FromCollection;

class HomeExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $sach = HomeModel::getAllSachExport(); // lấy dữ liệu

        $cols = [
            "Mã sách",
            "Tên sách",
            "Nội dung",
            "Số trang",
            "Giá tiền",
            "Số lượng",
            "Ngày nhập",
            "Thể loại",
            "Tên NXB",
            "Chuyên ngành",
            "Tác giả"
        ]; // tên cột

        $column = (object) null;
        foreach ($cols as $key => $col) {
            $column->{$col} = $col;
        }
        return collect(array_merge([$column],$sach));
                // return HomeModel::all();
    }
}
