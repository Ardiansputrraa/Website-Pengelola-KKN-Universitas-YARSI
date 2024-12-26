<?php

namespace App\Http\Controllers;

use App\Models\DPL;
use App\Models\Mahasiswa;
use App\Models\KelompokKKN;
use Illuminate\Http\Request;
use App\Models\KelompokMahasiswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Validator;

class DplController extends Controller
{
    public function viewKelompokKKNDPL()
    {
        $user = Auth::user();
        if ($user->dpl) {
            $kelompok_kkn = KelompokKKN::where('dpl_id', $user->dpl->id)->first();

            if ($kelompok_kkn) {
                $daftar_mahasiswa = Mahasiswa::whereIn('id', $kelompok_kkn->kelompokMahasiswa->pluck('mahasiswa_id'))->get();
            } else {
                $daftar_mahasiswa = collect();
            }
        } else {
            $daftar_mahasiswa = collect();
        }


        return view('informasi.dpl.kelompok', compact('daftar_mahasiswa', 'kelompok_kkn'));
    }

    public function viewBlankDpl() {
        
        return view('informasi.dpl._404');
    }
}
