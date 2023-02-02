<?php

namespace App\Http\Controllers;

use App\Exports\HomeExport;
use App\Models\ChuyenNganhModel;
use App\Models\HomeModel;
use App\Models\NXBModel;
use App\Models\TacGiaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use SebastianBergmann\Environment\Console;
use Illuminate\Support\Facades\Mail;
// use Mail;

class HomeController extends Controller
{
    function getAllSach(Request $request)
{
        $keywordsach = $request->input('keywordsach', '');
        $sachs = HomeModel::getAllSach($keywordsach);
        if (empty($keywordsach)) {
            $sachs = DB::table('sach')->paginate(6);
        } else {
            $sachs = DB::table('sach')->select('*')->where('ten_sach', 'LIKE', '%' . $keywordsach . '%')->paginate(6);
        }

        return view('trangchu', compact('keywordsach'))->with('sachs', $sachs);
    }

    public function status_update_sach($ma_sach){
        $sachs = DB::table('sach')->select('tinh_trang')->where('ma_sach', '=', $ma_sach)->first();

        if($sachs->tinh_trang == '1'){
            $tinh_trang = 0;
        }else{
            $tinh_trang = 1;
        }

        $valueSach = array('tinh_trang' => $tinh_trang);
        DB::table('sach')->where('ma_sach', $ma_sach)->update($valueSach);
        return redirect('/trangchu');
    }

    function chontheloai(){
        $tenTacGia = '';
        $tenNXB = '';
        $chuyen_nganh = '';
        $NXBs = NXBModel::getAllNXB($tenNXB);
        $theloais = HomeModel::chontheloai();
        $tacgias = TacGiaModel::getAllTacGia($tenTacGia);
        $CNs = ChuyenNganhModel::getAllCN($chuyen_nganh);
        return view('insert', [
            'theloais' => $theloais,
            'tacgias' => $tacgias,
            'NXBs' => $NXBs,
            'CNs' => $CNs
        ]);
    }

    function createSach(Request $request){
        $ma_sach = $request->ma_sach;
        $gia_tien = $request->gia_tien;
        $so_trang = $request->so_trang;
        $ten_sach = $request->ten_sach;
        $so_luong = $request->so_luong;
        $ma_TG = $request->ma_TG;
        $ma_TL = $request->ma_TL;
        $ma_NXB = $request->ma_NXB;
        $ma_CN = $request->ma_CN;
        $noi_dung = $request->noi_dung;
        $ngay_nhap = $request->ngay_nhap;
        $tinh_trang = $request->tinh_trang;

        $fileName = time().".".$request->file('image')->extension();
        //  Lưu ảnh vào thư mục public của storage
        $request->file('image')->storeAs('public',$fileName);
        //  Tạo link liên kết từ Storage ra thư mục public bên ngoài
        //  php artisan storage:link
        //  Link ảnh mới: storage/cat.jpg
        $image = 'storage/'.$fileName;
        // dd($request);


        $this->validate($request, [
            'gia_tien' => 'required',
            'gia_tien' => 'required|numeric|min:0|not_in:0',
            'ten_sach' => 'required|unique:sach',
            'so_trang' => 'required',
            'so_trang' => 'required|numeric|min:0|not_in:0',
            'so_luong' => 'required',
            'so_luong' => 'required|numeric|min:0|not_in:0',
            'ma_TG' => 'required',
            'ma_TL' => 'required',
            'ma_NXB' => 'required',
            'ma_CN' => 'required',
            'ngay_nhap' => 'required',
        ], [
            'gia_tien.required' => 'Vui lòng nhập Giá tiền!',
            'gia_tien.min' => 'Sai định dạng Giá tiền!',
            'gia_tien.not_in' => 'Sai định dạng Giá tiền!',
            'ten_sach.required' => 'Vui lòng nhập Tên sách!',
            'ten_sach.unique' => 'Sách đã tồn tại trong thư viện!',
            'so_trang.required' => 'Vui lòng nhập Số trang sách!',
            'so_trang.min' => 'Sai định dạng Số trang!',
            'so_trang.not_in' => 'Sai định dạng Số trang!',
            'so_luong.required' => 'Vui lòng nhập Số lượng sách!',
            'so_luong.min' => 'Sai định dạng Số lượng!',
            'so_luong.not_in' => 'Sai định dạng Số lượng!',
            'ma_TG.required' => 'Vui lòng chọn Tác giả!',
            'ma_NXB.required' => 'Vui lòng chọn Nhà xuất bản!',
            'ma_TL.required' => 'Vui lòng chọn Thể loại!',
            'ma-CN.required' => 'Vui lòng chọn Chuyên ngành!',
            'ngay_nhap.required' => 'Vui lòng chọn Ngày nhập!',
        ]);
        $rs = HomeModel::addNewSach($ma_sach, $ten_sach,$image, $noi_dung, $so_trang, $gia_tien, $so_luong, $ngay_nhap, $ma_TL, $ma_NXB, $ma_CN, $tinh_trang);
        $lastRow = DB::table("sach")->orderBy('ma_sach', 'desc')->first();
        for ($i = 0; $i < sizeof($ma_TG); $i++) {
            DB::table("sach_tg")->insert([
                'ma_TG' => $ma_TG[$i],
                'ma_sach' => $lastRow->ma_sach
            ]);
        }

        if ($rs) {
            return redirect('/trangchu');
        } else {
            $tenTacGia = '';
            $tenNXB = '';
            $chuyen_nganh = '';
            $NXBs = NXBModel::getAllNXB($tenNXB);
            $theloais = HomeModel::chontheloai();
            $tacgias = TacGiaModel::getAllTacGia($tenTacGia);
            $CNs = ChuyenNganhModel::getAllCN($chuyen_nganh);
            return view('insert', [
                'theloais' => $theloais,
                'tacgias' => $tacgias,
                'NXBs' => $NXBs,
                'CNs' => $CNs
            ])->with('err', 'Vui lòng thử lại !');
        }
    }


    function editSach($ma_sach){
        $tentacgia = '';
        $tenNXB = '';
        $chuyen_nganh = '';
        $tacgias = TacGiaModel::getAllTacGia($tentacgia);
        $NXBs = NXBModel::getAllNXB($tenNXB);
        $sach = HomeModel::getSach($ma_sach);
        $theloais = HomeModel::chontheloai();
        $CNs = ChuyenNganhModel::getAllCN($chuyen_nganh);
        $tgs = DB::table("sach_tg")->select("ma_TG")->where("ma_sach", $ma_sach)->get();
        $valueTG = [];
        for ($i = 0; $i < sizeof($tgs); $i++) {
            array_push($valueTG, $tgs[$i]->ma_TG);
        }

        return view('update', [
            'sach' => $sach,
            'tacgias' => $tacgias,
            'theloais' => $theloais,
            'NXBs' => $NXBs,
            'CNs' => $CNs,
            'valueTG' => $valueTG,
            // 'valueTL' => $valueTL,
            // 'valueNXB' => $valueNXB,
            // 'valueCN' => $valueCN,
        ]);
    }

    function processUpdateSach(Request $request, $id){
        $ma_sach = $id;
        $gia_tien = $request->gia_tien;
        $so_trang = $request->so_trang;
        $ten_sach = $request->ten_sach;
        $so_luong = $request->so_luong;
        $ma_TG = $request->ma_TG;
        $ma_TL = $request->ma_TL;
        $ma_NXB = $request->ma_NXB;
        $ma_CN = $request->ma_CN;
        $noi_dung = $request->noi_dung;
        $ngay_nhap = $request->ngay_nhap;
        $image = NULL;

        //  Cần kiểm tra xem người dùng có cập nhật lại ảnh hay ko ?
        if($request->file('image')->getSize() > 0){
            $fileName = time().".".$request->file('image')->extension();
            $request->file('image')->storeAs('public',$fileName);
            $image = 'storage/'.$fileName;
        }


        // $this->validate($request, [
        //     'gia_tien' => 'required',
        //     'gia_tien' => 'required|numeric|min:0|not_in:0',
        //     'ten_sach' => 'required|unique:sach',
        //     'so_trang' => 'required',
        //     'so_trang' => 'required|numeric|min:0|not_in:0',
        //     'so_luong' => 'required',
        //     'so_luong' => 'required|numeric|min:0|not_in:0',
        //     'ma_TG' => 'required',
        //     'ma_TL' => 'required',
        //     'ma_NXB' => 'required',
        //     'ma_CN' => 'required',
        //     'ngay_nhap' => 'required',
        // ], [
        //     'gia_tien.required' => 'Vui lòng nhập Giá tiền!',
        //     'gia_tien.min' => 'Sai định dạng Giá tiền!',
        //     'gia_tien.not_in' => 'Sai định dạng Giá tiền!',
        //     'ten_sach.required' => 'Vui lòng nhập Tên sách!',
        //     'ten_sach.unique' => 'Sách đã tồn tại trong thư viện!',
        //     'so_trang.required' => 'Vui lòng nhập Số trang sách!',
        //     'so_trang.min' => 'Sai định dạng Số trang!',
        //     'so_trang.not_in' => 'Sai định dạng Số trang!',
        //     'so_luong.required' => 'Vui lòng nhập Số lượng sách!',
        //     'so_luong.min' => 'Sai định dạng Số lượng!',
        //     'so_luong.not_in' => 'Sai định dạng Số lượng!',
        //     'ma_TG.required' => 'Vui lòng chọn Tác giả!',
        //     'ma_NXB.required' => 'Vui lòng chọn Nhà xuất bản!',
        //     'ma_TL.required' => 'Vui lòng chọn Thể loại!',
        //     'ma-CN.required' => 'Vui lòng chọn Chuyên ngành!',
        //     'ngay_nhap.required' => 'Vui lòng chọn Ngày nhập!',
        // ]);

        $tgs = DB::table("sach_tg")->select("ma_TG")->where("ma_sach", $ma_sach)->get();
        $valueTG = [];
        for ($i = 0; $i < sizeof($tgs); $i++) {
            array_push($valueTG, $tgs[$i]->ma_TG);
        }
        for ($i = 0; $i < sizeof($ma_TG); $i++) {
            if (!in_array($ma_TG[$i], $valueTG)) {
                DB::table('sach_tg')->insert([
                    'ma_sach' => $ma_sach,
                    "ma_TG" => $ma_TG[$i]
                ]);
            }
        }
        for ($i = 0; $i < sizeof($valueTG); $i++) {
            if (!in_array($valueTG[$i], $ma_TG)) {
                DB::table('sach_tg')->where("ma_sach", $ma_sach)->where("ma_TG", $valueTG[$i])->delete();
            }
        }

        $rs = HomeModel::updateSach($ma_sach, $ten_sach, $image, $noi_dung, $so_trang, $gia_tien, $so_luong, $ngay_nhap, $ma_TL, $ma_NXB, $ma_CN);

        $rs = DB::table("sach")->where('ma_sach', $ma_sach)->update([
            "ten_sach" => $ten_sach,
            "noi_dung" => $noi_dung,
            "so_trang" => $so_trang,
            "gia_tien" => $gia_tien,
            "so_luong" => $so_luong,
            "ngay_nhap" => $ngay_nhap,
            "ma_TL" => $ma_TL,
            "ma_NXB" => $ma_NXB,
            "ma_CN" => $ma_CN,
        ]);
        return redirect('/chitietsach/'.$id);
    }

    function chitietSach($ma_sach){
        $chitiets = DB::table('sach')->select('sach.ma_sach', 'sach.ten_sach', 'sach.image', 'sach.noi_dung', 'sach.so_trang', 'sach.gia_tien', 'sach.so_luong', 'sach.ngay_nhap', 'the_loai.the_loai', 'chuyen_nganh.chuyen_nganh', 'nha_xuat_ban.nha_xuat_ban',)
        ->join('the_loai', 'the_loai.ma_TL', '=', 'sach.ma_TL')
        ->join('chuyen_nganh', 'chuyen_nganh.ma_CN', '=', 'sach.ma_CN')
        ->join('nha_xuat_ban', 'nha_xuat_ban.ma_NXB', '=', 'sach.ma_NXB')
        ->where('sach.ma_sach', $ma_sach)
        ->get();

        $tgs = DB::table("sach_tg")->join("tac_gia", "tac_gia.ma_TG", "=", "sach_tg.ma_TG")->where("ma_sach", $ma_sach)->get();

        return view('chitietsach',[
            'chitiets' => $chitiets,
            'tgs' => $tgs,
        ]);
    }
    public function export_sach(){
        return Excel::download(new HomeExport, 'sach.xlsx');
    }

    public function testEmail(){
        $name = 'BKACAD';
        Mail::send('emails.test', compact('name'), function($email) use($name){
            $email->subject('Demo test email');
            $email->to('ptramy967@gmail.com', $name);
        });
    }
}
