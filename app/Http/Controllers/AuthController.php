<?php

namespace App\Http\Controllers;

use App\Models\DPL;
use App\Models\User;
use App\Models\Admin;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;



class AuthController extends Controller
{
    public function register(Request $request, User $User)
    {

        if ($request->user()->cannot('viewRegister', $User)) {
            abort(404);
        }

        $role = $request->query('role');
        return view('auth.register', ['role' => $role]);
    }

    public function registerSave(Request $request)
    {
        if ($request->user()->cannot('createAccount', User::class)) {
            abort(404);
        }

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

    public function login()
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

    public function logout(Request $request)
    {

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('msg', 'Anda Telah Berhasil Logout');
    }
}
