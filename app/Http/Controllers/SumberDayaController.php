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

    public function uploadSumberDaya(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'file' => 'required|file|mimes:jpg,jpeg,png,pdf,docx,ppt',
        ]);

        $file = $request->file('file');
        $fileSize = $file->getSize();
        $fileName = $file->getClientOriginalName();
        $filePath = 'storage/images/sumber-daya/' . $fileName;
        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
        }
        $file->move(public_path('storage/images/sumber-daya'), $fileName);

        $SumberDaya = SumberDaya::create([
            'path' => $filePath,
            'judul' => $request->judul,
            'tipe_file' => $file->getClientMimeType(),
            'size' => $fileSize,
        ]);


        return response()->json(['success' => 'Sumber daya berhasil diunggah.'], 200);   
    }

    function deleteSumberDaya($id) {
        $sumber_daya = SumberDaya::find($id);
        $filePath = public_path($sumber_daya->path);
        if ($sumber_daya) {
            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
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
