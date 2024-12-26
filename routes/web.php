<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DplController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LogbookController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KalenderController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\SumberDayaController;

Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'viewLogin')->name('login');
    Route::post('login-check', 'loginCheck')->name('login.check');
});

Route::middleware(['auth'])->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('register', 'viewRegister')->name('register');
        Route::post('register-save', 'registerSave')->name('register.save');
        Route::get('ubah-password', 'ubahPassword')->name('ubah.password');
        Route::post('update-password', 'updatePassword')->name('update.password');
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get('view-data-mahasiswa', 'viewDataMahasiswa')->name('view.data.mahasiswa');
        Route::get('get-data-mahasiswa', 'getDataMahasiswa')->name('get.data.mahasiswa');
        Route::get('view-detail-data-mahasiswa/{user_id}', 'viewDetailDataMahasiswa')->name('view.detail.data.mahasiswa');
        Route::post('update-data-mahasiswa', 'updateDataMahasiswa')->name('update.data.mahasiswa');
        Route::get('delete-data-mahasiswa/{user_id}', 'deleteDataMahasiswa')->name('delete.data.mahasiswa');
        Route::get('search-data-mahasiswa', 'searchDataMahasiswa')->name('search.data.mahasiswa');
        Route::get('download-data-mahasiswa', 'downloadDataMahasiswa')->name('download.data.mahasiswa');
        
        Route::get('view-data-dpl', 'viewDataDpl')->name('view.data.dpl');
        Route::get('get-data-dpl', 'getDataDpl')->name('get.data.dpl');
        Route::get('view-detail-data-dpl/{user_id}', 'viewDetailDataDpl')->name('view.detail.data.dpl');
        Route::post('update-data-dpl', 'updateDataDpl')->name('update.data.dpl');
        Route::get('delete-data-dpl/{user_id}', 'deleteDataDpl')->name('delete.data.dpl');
        Route::get('search-data-dpl', 'searchDataDpl')->name('search.data.dpl');
        Route::get('download-data-dpl', 'downloadDataDpl')->name('download.data.dpl');

        Route::get('view-data-kelompok', 'viewDataKelompok')->name('view.data.kelompok');
        Route::get('view-create-data-kelompok', 'viewCreateDataKelompok')->name('view-create.data.kelompok');
        Route::post('create-kelompok-kkn', 'createKelompokKKN')->name('create.kelompok.kkn');
        Route::post('add-mahasiswa-to-kelompok', 'addMahasiswaToKelompokKKN')->name('add.mahasiswa.to.kelompok');
        Route::get('view-detail-data-kelompok/{kelompok_id}', 'viewDetailDataKelompok')->name('view-detail.data.kelompok');
        Route::post('edit-data-kelompok-kkn/{kelompok_id}', 'editDataKelompokKKN')->name('edit.data.kelompok.kkn');
        Route::get('search-data-kelompok-mahasiswa', 'searchDataKelompokMahasiswa')->name('search.data.kelompok.mahasiswa');
        Route::post('delete-data-kelompok-mahasiswa', 'deleteDataKelompokMahasiswa')->name('delete.data.kelompok.mahasiswa');
        Route::post('delete-data-kelompok-kkn', 'deleteDataKelompokKKN')->name('delete.data.kelompok.kkn');
        Route::get('search-data-kelompok-kkn', 'searchDataKelompokKKN')->name('search.data.kelompok.kkn');
        Route::get('download-data-kelompok-kkn', 'downloadDataKelompokKKN')->name('download.data.kelompok.kkn');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::controller(MahasiswaController::class)->group(function () {
        Route::post('daftar-kkn-reguler', 'daftarKknReguler')->name('daftar.kkn.reguler');
        Route::get('view-kelompok-kkn', 'viewKelompokKKN')->name('view.kelompok.kkn');
        Route::get('view-dpl-kkn', 'viewDPLKKN')->name('view.dpl.kkn');
        Route::get('view-blank-mahasiswa-kelompok', 'viewBlankMahasiswa')->name('view.blank.mahasiswa.kelompok');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::controller(DplController::class)->group(function () {
        Route::get('view-kelompok-kkn-dpl', 'viewKelompokKKNDPL')->name('view.kelompok.kkn.dpl');
        Route::get('view-blank-dpl-kelompok', 'viewBlankDpl')->name('view.blank.dpl.kelompok');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::controller(LogbookController::class)->group(function () {
        Route::get('view-logbook-mahasiswa/{mahasiswa_id}', 'viewLogbookMahasiswa')->name('view.logbook.mahasiswa');
        Route::post('create-logbook-mahasiswa', 'createLogbookMahasiswa')->name('create.logbook.mahasiswa');
        Route::get('detail-logbook/{logbook_id}', 'detailLogbook')->name('detail.logbook');
        Route::post('edit-logbook', 'editLogbook')->name('edit.logbook');
        Route::get('delete-logbook/{logbook_id}', 'deleteLogbook')->name('delete.logbook');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::controller(ProfileController::class)->group(function () {
        Route::get('profile', 'viewProfile')->name('profile');
        Route::post('update-profile', 'updateProfile')->name('profile.update');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::controller(KalenderController::class)->group(function () {
        Route::get('view-kalender-kegiatan', 'viewKalenderKegiatan')->name('view.kalender.kegiatan');
        Route::post('create-kalender-kegiatan', 'createKalenderKegiatan')->name('create.kalender.kegiatan');
        Route::get('detail-kalender-kegiatan/{kalender_id}', 'detailKalenderKegiatan')->name('detail.kalender.kegiatan');
        Route::post('update-kalender-kegiatan', 'updateKalenderKegiatan')->name('update.kalender.kegiatan');
        Route::get('delete-kalender-kegiatan/{kalender_id}', 'deleteKalenderKegiatan')->name('delete.kalender.kegiatan');
        Route::get('download-kalender-kegiatan', 'downloadKalenderKegiatan')->name('download.kalender.kegiatan');
        Route::get('search-kalender-kegiatan', 'searchKalenderKegiatan')->name('search.kalender.kegiatan');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::controller(SumberDayaController::class)->group(function () {
        Route::get('view-sumber-daya', 'viewSumberDaya')->name('view.sumber.daya');
        Route::post('upload-sumber-daya', 'uploadSumberDaya')->name('upload.sumber.daya');
        Route::get('delete-sumber-daya/{sumber_daya_id}', 'deleteSumberDaya')->name('delete.sumber.daya');
        Route::get('detail-sumber-daya/{sumber_daya_id}', 'detailSumberDaya')->name('detail.sumber.daya');
        Route::get('download-sumber-daya/{sumber_daya_id}', 'downloadSumberDaya')->name('download.sumber.daya');
        Route::post('edit-sumber-daya', 'editSumberDaya')->name('edit.sumber.daya');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::get('/pwngajuan-kkn', function () {
        $user = Auth::user();
        return view('daftar.daftar-kkn', compact('user'));
    });
});