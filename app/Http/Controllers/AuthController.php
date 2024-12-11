<?php

namespace App\Http\Controllers;

use App\Models\DPL;
use App\Models\User;
use App\Models\Admin;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;



class AuthController extends Controller
{
    public function viewRegister(Request $request, User $User)
    {

        $this->authorize('viewRegister', User::class);

        $role = $request->query('role');
        return view('auth.register', ['role' => $role]);
    }

    public function registerSave(Request $request)
    {
        $this->authorize('createAccount', User::class);

        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users,username',
            'password' => 'required',
            'role' => 'required|in:admin,dpl,mahasiswa',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        if ($request->role === 'admin') {
            Admin::create([
                'user_id' => $user->id,
                'nama_lengkap' => $request->namaLengkap,
                'foto' => 'storage/images/profiles/profile.jpeg',
            ]);
        } else if ($request->role === 'mahasiswa') {
            Mahasiswa::create([
                'user_id' => $user->id,
                'nama_lengkap' => $request->namaLengkap,
                'foto' => 'storage/images/profiles/profile.jpeg',
                'status' => 'belum terdaftar'
            ]);
        } else if ($request->role === 'dpl') {
            DPL::create([
                'user_id' => $user->id,
                'nama_lengkap' => $request->namaLengkap,
                'foto' => 'storage/images/profiles/profile.jpeg',
                'status' => 'belum terdaftar',
            ]);
        } else {
            return response()->json(['info' => 'Tentukan role akun terlebih dahulu.'], 200);
        }
        return response()->json(['success' => 'Registrasi berhasil.'], 200);
    }

    public function viewLogin()
    {
        return view('auth.login');
    }

    public function loginCheck(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (!Auth::attempt($request->only('username', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'username' => trans('auth.failed')
            ]);
        }

        $user = Auth::user();

        $request->session()->regenerate();

        return response()->json([
            'msg' => 'Login berhasil.',
            'user' => $user,
        ], 200);
    }

    public function ubahPassword(){
        $user = Auth::user();
        return view('auth.ubah-password', compact('user'));
    }

    public function updatePassword(Request $request)
    {

        $user = User::where('username', $request->username)->first();

        if (!Hash::check($request->passwordLama, $user->password)) {
            return response()->json([
                'message' => 'Password lama tidak sesuai.',
            ], 400);
        }

        $user->password = Hash::make($request->passwordBaru);
        $user->save();

        return response()->json([
            'message' => 'Password berhasil diubah.',
        ], 200);
    }

    public function logout(Request $request)
    {

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('msg', 'Anda Telah Berhasil Logout');
    }
}
