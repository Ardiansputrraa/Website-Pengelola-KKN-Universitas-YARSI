<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        return view('profile.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {

        $users = Auth::user();
        Log::info($users);

        if ($users->role == 'admin') {
            if ($request->hasFile('foto')) {
                if ($users->admin->foto && Storage::exists($users->admin->foto)) {
                    Storage::delete($users->admin->foto);
                }

                $image = $request->file('foto');
                $imageName = $users->username . '.' . $image->getClientOriginalExtension();
                $path = 'storage/images/profiles/' . $imageName;
                $image->move(public_path('storage/images/profiles'), $imageName);

                $users->admin->foto = $path;
            }

            $users->admin->nama_lengkap = $request->namaLengkap;
            $users->admin->email = $request->email;
            $users->admin->nomer_whatsapp = $request->nomerWhatsapp;
            $users->admin->save();
        } else if ($users->role == 'mahasiswa') {
            if ($request->hasFile('foto')) {
                if ($users->mahasiswa->foto && Storage::exists($users->mahasiswa->foto)) {
                    Storage::delete($users->mahasiswa->foto);
                }

                $image = $request->file('foto');
                $imageName = $users->username . '.' . $image->getClientOriginalExtension();
                $path = 'storage/images/profiles/' . $imageName;
                $image->move(public_path('storage/images/profiles'), $imageName);

                $users->mahasiswa->foto = $path;
            }

            $validator = Validator::make($request->all(), [
                'email' => 'email|unique:mahasiswa,email,',
                'npm' => 'unique:mahasiswa,npm,',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $users->mahasiswa->nama_lengkap = $request->namaLengkap;
            $users->mahasiswa->npm = $request->npm;
            $users->mahasiswa->fakultas = $request->fakultas;
            $users->mahasiswa->prodi = $request->prodi;
            $users->mahasiswa->email = $request->email;
            $users->mahasiswa->nomer_whatsapp = $request->nomerWhatsapp;
            $users->mahasiswa->save();
        } else if ($users->role == 'dpl') {
            if ($request->hasFile('foto')) {
                if ($users->dpl->foto && Storage::exists($users->dpl->foto)) {
                    Storage::delete($users->dpl->foto);
                }

                $image = $request->file('foto');
                $imageName = $users->username . '.' . $image->getClientOriginalExtension();
                $path = 'storage/images/profiles/' . $imageName;
                $image->move(public_path('storage/images/profiles'), $imageName);

                $users->dpl->foto = $path;
            }

            $validator = Validator::make($request->all(), [
                'email' => 'email|unique:dpl,email,',
                'nip' => 'unique:dpl,nip,',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            
            $users->dpl->nama_lengkap = $request->namaLengkap;
            if ($request->nip !== null) {
                $users->dpl->nip = $request->nip;
            }
            $users->dpl->gelar = $request->gelar;
            $users->dpl->fakultas = $request->fakultas;
            $users->dpl->prodi = $request->prodi;
            $users->dpl->nama_bank = $request->namaBank;
            $users->dpl->nomer_rekening = $request->nomerRekening;
            if ($request->email !== null) {
                $users->dpl->email = $request->email;
            }
            $users->dpl->nomer_whatsapp = $request->nomerWhatsapp;
            $users->dpl->save();
        }
        return redirect()->back()->with('success', 'Profile Berhasil Diubah.');
    }
}
