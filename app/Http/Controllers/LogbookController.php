<?php

namespace App\Http\Controllers;

use App\Models\Logbook;
use App\Models\Mahasiswa;
use App\Models\KelompokKKN;
use Illuminate\Http\Request;
use App\Models\KelompokMahasiswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class LogbookController extends Controller
{
    public function viewLogbookMahasiswa($id)
    {
        $logbook = Logbook::where('mahasiswa_id', $id)->get();
        $mahasiswa = Mahasiswa::where('id', $id)->first();
        return view('logbook.logbook', compact('logbook', 'mahasiswa'));
    }

    public function createLogbookMahasiswa(Request $request)
    {
        $request->validate([
            'foto' => 'required|file|mimes:jpeg,jpg,png|max:2048',
            'tanggal' => 'required|date',
            'waktu' => 'required|string',
            'kegiatan' => 'required|string',
            'tempat' => 'required|string',
        ]);


        $user = Auth::user();
        $kelompok_mahasiswa = KelompokMahasiswa::where('mahasiswa_id', $user->mahasiswa->id)->first();

        $file = $request->file('foto');
        $fileName = $file->getClientOriginalName();
        $filePath = 'storage/images/foto-logbook/' . $fileName;
        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
        }
        $file->move(public_path('storage/images/foto-logbook'), $fileName);

        $logbook = Logbook::create([
            'mahasiswa_id' => $user->mahasiswa->id,
            'kelompok_kkn_id' => $kelompok_mahasiswa->kelompok_kkn_id,
            'tanggal' => $request->tanggal,
            'jam' => $request->waktu,
            'kegiatan' => $request->kegiatan,
            'tempat' => $request->tempat,
            'file_foto' => $filePath,
        ]);

        return response()->json(['success' => 'Logbook berhasil dibuat.'], 200);
    }

    public function detailLogbook($id)
    {
        try {
            $logbook = Logbook::findOrFail($id);
            return response()->json(['data' => $logbook], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Data tidak ditemukan.'], 404);
        }
    }

    public function editLogbook(Request $request)
    {
        $id = $request->id;

        $logbook = Logbook::find($id);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = $file->getClientOriginalName();
            $filePath = 'storage/images/sumber-daya/' . $fileName;
            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }
            $file->move(public_path('storage/images/sumber-daya'), $fileName);

            $logbook->update([
                'file_foto' => $filePath,
                'tanggal' => $request->tanggal,
                'waktu' => $request->waktu,
                'tempat' => $request->tempat,
                'kegiatan' => $request->kegiatan,
            ]);
        } else {
            $logbook->update([
                'tanggal' => $request->tanggal,
                'waktu' => $request->waktu,
                'tempat' => $request->tempat,
                'kegiatan' => $request->kegiatan,
            ]);
        }

        return response()->json(['success' => 'Logbook kegiatan berhasil diubah.'], 200);
    }

    function deleteLogbook($id)
    {
        $logbook = Logbook::find($id);
        $filePath = public_path($logbook->file_foto);
        if ($logbook) {
            if (file_exists($filePath)) {
                unlink($filePath); 
            }
            $logbook->delete();
        }
        return response()->json(['success' => 'Logbook berhasil dihapus.'], 200);
    }
}
