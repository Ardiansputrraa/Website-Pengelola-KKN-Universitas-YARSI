<?php

use Illuminate\Support\Facades\Route;
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
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get('mahasiswa', 'viewDataMahasiswa')->name('mahasiswa');
        Route::get('get-data-mahasiswa', 'getDataMahasiswa')->name('get.data.mahasiswa');
        Route::get('view-detail-data-mahasiswa/{user_id}', 'viewDetailDataMahasiswa')->name('view.detail.data.mahasiswa');
        Route::post('update-data-mahasiswa', 'updateDataMahasiswa')->name('update.data.mahasiswa');
        Route::get('delete-data-mahasiswa/{user_id}', 'deleteDataMahasiswa')->name('delete.data.mahasiswa');
        Route::get('search-data-mahasiswa', 'searchDataMahasiswa')->name('search.data.mahasiswa');
        Route::get('download-data-mahasiswa', 'downloadDataMahasiswa')->name('download.data.mahasiswa');
        
        Route::get('dpl', 'viewDataDpl')->name('dpl');
        Route::get('get-data-dpl', 'getDataDpl')->name('get.data.dpl');
        Route::get('view-detail-data-dpl/{user_id}', 'viewDetailDataDpl')->name('view.detail.data.dpl');
        Route::post('update-data-dpl', 'updateDataDpl')->name('update.data.dpl');
        Route::get('delete-data-dpl/{user_id}', 'deleteDataDpl')->name('delete.data.dpl');
        Route::get('search-data-dpl', 'searchDataDpl')->name('search.data.dpl');
        Route::get('download-data-dpl', 'downloadDataDpl')->name('download.data.dpl');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::controller(MahasiswaController::class)->group(function () {
        
    });
});

Route::middleware(['auth'])->group(function () {
    Route::controller(ProfileController::class)->group(function () {
        Route::get('profile', 'viewProfile')->name('profile');
        Route::post('update-profile', 'updateProfile')->name('profile.update');
    });
});