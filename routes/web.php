<?php

use App\Http\Controllers\LoiPhatController;
use App\Http\Controllers\ChuyenNganhController;
use App\Http\Controllers\DocGiaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TacGiaController;
use App\Http\Controllers\TheLoaiController;
use App\Http\Controllers\NXBController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PhieuMuonController;
use App\Http\Controllers\sachdangmuonController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Phạt lỗi
Route::get('/loiphat',[LoiPhatController::class,'getAllLoi'])->name('searchloi');
Route::get('/themloi', function(){
    return view('themloi');
});
Route::post('/themloi', [LoiPhatController::class,'themloi']);
Route::get('/xoaloi/{ma_Phat}', [LoiPhatController::class, 'xoaLoi']);
Route::get('/sualoi/{ma_Phat}', [LoiPhatController::class, 'editLoi']);
Route::post('/sualoi/{ma_Phat}', [LoiPhatController::class, 'processUpdateLoi']);

//Chuyên ngành
Route::get('/chuyennganh',[ChuyenNganhController::class,'getAllCN'])->name('searchCN');
Route::get('/themCN', function(){
    return view('themCN');
});
Route::post('/themCN', [ChuyenNganhController::class,'themCN']);
Route::get('/xoaCN/{ma_CN}', [ChuyenNganhController::class, 'xoaCN']);
Route::get('/suaCN/{ma_CN}', [ChuyenNganhController::class, 'editCN']);
Route::post('/suaCN/{ma_CN}', [ChuyenNganhController::class, 'processUpdateCN']);

//Độc giả
Route::get('/docgia', [DocGiaController::class, 'getAllDocGia'])->name('searchdocgia');
Route::get('/themdocgia', function(){
    return view('themdocgia');
});
Route::get('/chitietdocgia/{ma_DG}',[DocGiaController::class,'chitietDocGia']);
Route::post('/themdocgia', [DocGiaController::class,'themDocGia']);
Route::get('suadocgia/{ma_DG}', [DocGiaController::class, 'editDocGia']);
Route::post('suadocgia/{ma_DG}', [DocGiaController::class, 'processUpdateDocGia']);
Route::get('/delete/{ma_DG}', [DocGiaController::class, 'deleteDocGia']);
Route::get('/sachdamuon', function () {
    return view('sachdamuon');
});
Route::get('/status_update_docgia/{ma_DG}', [DocGiaController::class, 'status_update_docgia']);
// //Sách
Route::get('/trangchu',[HomeController::class,'getAllSach'])->name('searchsach')->middleware('checklogin');
Route::get('test-email',[HomeController::class,'testEmail']);
Route::get('/edit/{ma_sach}',[HomeController::class,'editSach']);
Route::post('/updated/{ma_sach}',[HomeController::class,'processUpdateSach']);
Route::get('/deletesach/{ma_sach}',[HomeController::class,'deleteSach']);
Route::get('/create',[HomeController::class,'chontheloai']);
Route::post('/create',[HomeController::class,'createSach']);
Route::get('/chitietsach/{ma_sach}',[HomeController::class,'chitietSach']);
Route::get('/status_update_sach/{ma_sach}', [HomeController::class, 'status_update_sach']);


//Tác giả
Route::get('/tacgia',[TacgiaController::class,'getAllTacGia'])->name('searchTacGia');
Route::get('/themtacgia', function(){
    return view('themtacgia');
});
Route::post('/themtacgia', [TacGiaController::class,'themTacGia']);
Route::get('/xoatacgia/{ma_TG}', [TacGiaController::class, 'xoaTacGia']);
Route::get('/suatacgia/{ma_TG}', [TacGiaController::class, 'editTacGia']);
Route::post('/suatacgia/{ma_TG}', [TacGiaController::class, 'processUpdateTacGia']);

//Thể loại
Route::get('/theloai', [TheLoaiController::class, 'getAllTheLoai'])->name('searchTheLoai');
Route::get('/themtheloai', function(){
    return view('themtheloai');
});
Route::post('/themtheloai', [TheLoaiController::class,'themTheloai']);
Route::get('suatheloai/{ma_TL}', [TheLoaiController::class, 'editTheLoai']);
Route::post('suatheloai/{ma_TL}', [TheLoaiController::class, 'processUpdateTheLoai']);
Route::get('/xoatheloai/{ma_TL}', [TheLoaiController::class, 'deleteTheLoai']);
//NXB
Route::get('/NXB', [NXBController::class, 'getAllNXB'])->name('searchNXB');
Route::get('/themNXB', function(){
    return view('themNXB');
});
Route::post('/themNXB', [NXBController::class,'themNXB']);
Route::get('/xoaNXB/{ma_NXB}', [NXBController::class, 'deleteNXB']);
Route::get('suaNXB/{ma_NXB}', [NXBController::class, 'editNXB']);
Route::post('suaNXB/{ma_NXB}', [NXBController::class, 'processUpdateNXB']);
// Đăng nhập và xử lý đăng nhập
Route::get('/',[AdminController::class,'login']);
Route::get('/getlogin', [AdminController::class,'showLogin']);
Route::post('/postlogin', [AdminController::class,'login']);
Route::get('/logout', [AdminController::class,'logout']);
//phiếu mượn
Route::get('/phieumuon', function(){
    return view('phieumuon');
});
Route::get('/phieumuon',[PhieuMuonController::class,'getAllPhieuMuon'])->name('searchphieumuon');
Route::get('/themphieumuon', function(){
    return view('themphieumuon');
});
Route::get('/themphieumuon',[PhieuMuonController::class,'hiendocgia']);
Route::post('/themphieumuon', [PhieuMuonController::class,'addphieumuon']);
Route::get('editphieumuon/{ma_phieu}', [PhieuMuonController::class, 'editphieumuon']);
Route::get('/updatephieumuon', [PhieuMuonController::class, 'processUpdatephieumuon']);
Route::get('/quantity_update_sach/{ma_sach}', [PhieuMuonController::class, 'quantity_update_sach']);
//sách đang mượn
Route::get('/thong_ke', [sachdangmuonController::class,'getallchitiet']);
Route::get('thong_ke/sachdangmuon', [sachdangmuonController::class,'filter_by_date'])->name('thong_ke');
//chi tiết phiếu mượn
Route::get('/chitietphieumuon/{ma_phieu}',[PhieuMuonController::class,'chiTietPhieuMuon']);
Route::get('/themsachmuon/{ma_phieu}',[PhieuMuonController::class, 'showsach']);
Route::post('/themsachmuon/{ma_phieu}', [PhieuMuonController::class, 'addsach']);
Route::get('/editchitiet/{ma_phieu}/{ma_sach}',[PhieuMuonController::class,'editchitiet']);
// Route::get('/editchitiet/{ma_sach}',[PhieuMuonController::class,'shownamebook']);
Route::post('/updatedchitiet',[PhieuMuonController::class,'processUpdatechitiet'])->name('updatedchitiet');

//trả sách
Route::get('/trasach',[PhieuMuonController::class,'getAllTraSach'])->name('searchtrasach');
Route::get('/themtrasach/{ma_phieu}',[PhieuMuonController::class, 'showtrasach']);
Route::post('/themtrasach/{ma_phieu}', [PhieuMuonController::class, 'addtrasach']);
Route::get('/chitiettrasach/{ma_phieu}',[PhieuMuonController::class,'chitietTraSach']);

//Excel - Export
Route::get('/export_sach', [HomeController::class, 'export_sach'])->name('export_sach');
Route::get('/export_docgia', [DocGiaController::class, 'export_docgia'])->name('export_docgia');
Route::get('/export_tacgia', [TacGiaController::class, 'export_tacgia'])->name('export_tacgia');
Route::get('/export_NXB', [NXBController::class, 'export_NXB'])->name('export_NXB');
Route::get('/export_chuyennganh', [ChuyennganhController::class, 'export_chuyennganh'])->name('export_chuyennganh');
Route::get('/export_theloai', [TheLoaiController::class, 'export_theloai'])->name('export_theloai');
Route::get('/export_phatloi', [LoiPhatController::class, 'export_phatloi'])->name('export_phatloi');
Route::get('/export_phieumuon', [PhieuMuonController::class, 'export_phieumuon'])->name('export_phieumuon');

//Excel - Import
Route::get('/import-form-docgia', [DocGiaController::class, 'importFormDocGia']);
Route::post('/import-form-docgia', [DocGiaController::class, 'import_docgia'])->name('import_docgia');

Route::get('/import-form-tacgia', [TacGiaController::class, 'importFormTacGia']);
Route::post('/import-form-tacgia', [TacGiaController::class, 'import_tacgia'])->name('import_tacgia');

Route::get('/import-form-theloai', [TheLoaiController::class, 'importFormTheLoai']);
Route::post('/import-form-theloai', [TheLoaiController::class, 'import_theloai'])->name('import_theloai');

Route::get('/import-form-nhaxuatban', [NXBController::class, 'importFormNXB']);
Route::post('/import-form-nhaxuatban', [NXBController::class, 'import_nhaxuatban'])->name('import_nhaxuatban');

Route::get('/import-form-loiphat', [LoiPhatController::class, 'importFormLoiPhat']);
Route::post('/import-form-loiphat', [LoiPhatController::class, 'import_loiphat'])->name('import_loiphat');

Route::get('/import-form-chuyennganh', [ChuyenNganhController::class, 'importFormChuyenNganh']);
Route::post('/import-form-chuyennganh', [ChuyenNganhController::class, 'import_chuyennganh'])->name('import_chuyennganh');





