<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\SumberDaya;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class SumberDayaController extends Controller
{
    public function viewSumberDaya()
    {
        $sumber_daya = SumberDaya::all();
        return view('sumber-daya.sumber-daya', compact('sumber_daya'));
    }

    public function detailSumberDaya($id)
    {
        try {
            $sumber_daya = SumberDaya::findOrFail($id);
            return response()->json(['data' => $sumber_daya], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Data tidak ditemukan.'], 404);
        }
    }

    public function editSumberDaya(Request $request)
    {
        $id = $request->id;

        $sumberDaya = SumberDaya::find($id);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileSize = $file->getSize();
            $fileName = $file->getClientOriginalName();
            $filePath = 'storage/images/sumber-daya/' . $fileName;
            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }
            $file->move(public_path('storage/images/sumber-daya'), $fileName);
            $tipe = 'none';
            if ($file->getClientMimeType() == 'application/pdf') {
                $tipe = 'pdf';
            } else if ($file->getClientMimeType() == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
                $tipe = 'docx';
            } else if ($file->getClientMimeType() == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') {
                $tipe = 'xlsx';
            }
            $sumberDaya->update([
                'path' => $filePath,
                'judul' => $request->judul,
                'tipe_file' =>  $tipe,
                'size' => $fileSize,
            ]);
        } else {
            $sumberDaya->update([
                'judul' => $request->judul
            ]);
        }

        return response()->json(['success' => 'Kalender kegiatan berhasil diubah.'], 200);
    }

    public function uploadSumberDaya(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,docx,ppt,xlsx,xls',
        ]);

        $file = $request->file('file');
        $fileSize = $file->getSize();
        $fileName = $file->getClientOriginalName();
        $filePath = 'storage/images/sumber-daya/' . $fileName;
        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
        }
        $file->move(public_path('storage/images/sumber-daya'), $fileName);
        $tipe = 'none';
        if ($file->getClientMimeType() == 'application/pdf') {
            $tipe = 'pdf';
        } else if ($file->getClientMimeType() == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
            $tipe = 'docx';
        } else if ($file->getClientMimeType() == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') {
            $tipe = 'xlsx';
        }
        $SumberDaya = SumberDaya::create([
            'path' => $filePath,
            'judul' => $request->judul,
            'tipe_file' =>  $tipe,
            'size' => $fileSize,
        ]);


        return response()->json(['success' => 'Sumber daya berhasil diunggah.'], 200);
    }

    function deleteSumberDaya($id)
    {
        $sumber_daya = SumberDaya::find($id);
        $filePath = public_path($sumber_daya->path);
        if ($sumber_daya) {
            if (file_exists($filePath)) {
                unlink($filePath); 
            }
            $sumber_daya->delete();
        }
        return response()->json(['success' => 'Sumber daya berhasil dihapus.'], 200);
    }

    public function downloadSumberDaya($id)
    {
        $sumberDaya = SumberDaya::findOrFail($id);

        $filePath = public_path($sumberDaya->path);

        if (file_exists($filePath)) {
            return response()->download($filePath, basename($filePath));
        } else {
            return response()->json(['error' => 'File tidak ditemukan.'], 404);
        }
    }
}
