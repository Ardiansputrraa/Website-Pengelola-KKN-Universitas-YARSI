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

class MahasiswaController extends Controller
{
    public function daftarKknReguler(Request $request)
    {
        $user_id = $request->user_id;
        $mahasiswa = Mahasiswa::where('user_id', $user_id)->first();

        $validator = Validator::make($request->all(), [
            'email' => 'email|unique:mahasiswa,email,'. $mahasiswa->id,
            'npm' => 'unique:mahasiswa,npm,'. $mahasiswa->id,
        ]);

        if ($validator->fails()) {
            if ($validator->errors()->has('email')) {
                return response()->json(['message' => 'Email sudah digunakan!'], 422);
            }
            if ($validator->errors()->has('npm')) {
                return response()->json(['message' => 'NPM sudah digunakan!'], 422);
            }
            return response()->json(['errors' => $validator->errors()], 422);
        }
        
        if ($mahasiswa) {
            $mahasiswa->nama_lengkap = $request->namaLengkap;
            $mahasiswa->npm = $request->npm;
            $mahasiswa->fakultas = $request->fakultas;
            $mahasiswa->prodi = $request->prodi;
            $mahasiswa->email = $request->email;
            $mahasiswa->nomer_whatsapp = $request->nomerWhatsapp;
            $mahasiswa->status = "diproses";

            if ($request->hasFile('file_ktm')) {
                if ($mahasiswa->file_ktm && Storage::exists($mahasiswa->file_ktm)) {
                    Storage::delete($mahasiswa->file_ktm);
                }

                $image = $request->file('file_ktm');
                $imageName = $mahasiswa->nama_lengkap . '.' . $image->getClientOriginalExtension();
                $path = 'storage/images/ktm/' . $imageName;
                $image->move(public_path('storage/images/ktm'), $imageName);

                $mahasiswa->file_ktm = $path;
            }

            $mahasiswa->update();

            return response()->json(['msg' => 'Data Mahasiswa Berhasil Diubah.'], 200);
        }
    }

    public function viewKelompokKKN() {
        $user = Auth::user();
    
        $kelompok_mahasiswa = KelompokMahasiswa::where('mahasiswa_id', $user->mahasiswa->id)->first();
        $kelompok_kkn = KelompokKKN::where('id', $kelompok_mahasiswa->kelompok_kkn_id)->first();
        
        if ($kelompok_mahasiswa) {
            $kelompok_kkn = KelompokKKN::find($kelompok_mahasiswa->kelompok_kkn_id);
    
            $daftar_mahasiswa = Mahasiswa::whereIn('id', $kelompok_kkn->kelompokMahasiswa->pluck('mahasiswa_id'))->get();
        } else {
            $daftar_mahasiswa = collect(); 
        }
    
        return view('informasi.mahasiswa.kelompok', compact('daftar_mahasiswa', 'kelompok_kkn'));
    }

    public function viewDPLKKN() {
        $user = Auth::user();
    
        $kelompok_mahasiswa = KelompokMahasiswa::where('mahasiswa_id', $user->mahasiswa->id)->first();
    
        if ($kelompok_mahasiswa) {
            $kelompok_kkn = KelompokKKN::find($kelompok_mahasiswa->kelompok_kkn_id);
    
            $dpl = DPL::find($kelompok_kkn->dpl_id);
        } else {
            $dpl = null;
        }
    
        return view('informasi.mahasiswa.dpl', compact('dpl'));
    }

    public function viewBlankMahasiswa() {
        
        return view('informasi.mahasiswa._404');
    }
    
}
