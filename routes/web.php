<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DplController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MahasiswaController;

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
    });
});

Route::middleware(['auth'])->group(function () {
    Route::controller(DplController::class)->group(function () {
        Route::get('view-kelompok-kkn-dpl', 'viewKelompokKKNDPL')->name('view.kelompok.kkn.dpl');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::controller(ProfileController::class)->group(function () {
        Route::get('profile', 'viewProfile')->name('profile');
        Route::post('update-profile', 'updateProfile')->name('profile.update');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::get('/pwngajuan-kkn', function () {
        $user = Auth::user();
        return view('daftar.daftar-kkn', compact('user'));
    });
});