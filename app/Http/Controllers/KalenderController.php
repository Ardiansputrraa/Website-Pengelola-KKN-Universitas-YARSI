<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KalenderKegiatan;
use Illuminate\Support\Facades\Response;

class KalenderController extends Controller
{
    public function viewKalenderKegiatan()
    {
        $kalender_kegiatan = KalenderKegiatan::all();
        return view('kalender-kegiatan.kalender-kegiatan', compact('kalender_kegiatan'));
    }

    public function createKalenderKegiatan(Request $request)
    {
        $kalender_kegiatan = KalenderKegiatan::create([
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu,
            'tempat' => $request->tempat,
            'pembahasan' => $request->pembahasan,
            'narasumber' => $request->narasumber,
        ]);

        return response()->json(['success' => 'Kalender kegiatan berhasil dibuat.'], 200);
    }

    public function detailKalenderKegiatan($id)
    {
        try {
            $kalender_kegiatan = KalenderKegiatan::findOrFail($id);
            return response()->json(['data' => $kalender_kegiatan], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Data tidak ditemukan.'], 404);
        }
    }

    public function updateKalenderKegiatan(Request $request)
    {
        $id = $request->id;

        $kalender_kegiatan = KalenderKegiatan::find($id);

        $kalender_kegiatan->update([
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu,
            'tempat' => $request->tempat,
            'pembahasan' => $request->pembahasan,
            'narasumber' => $request->narasumber,
        ]);

        return response()->json(['success' => 'Kalender kegiatan berhasil diubah.'], 200);
    }

    public function deleteKalenderKegiatan($id)
    {
        $deleted = KalenderKegiatan::where('id', $id)->delete();

        if ($deleted) {
            return response()->json(['success' => 'Kalender kegiatan berhasil dihapus.'], 200);
        } else {
            return response()->json(['error' => 'Data tidak ditemukan atau gagal dihapus.'], 404);
        }
    }

    public function downloadKalenderKegiatan()
    {
        $data = KalenderKegiatan::all();

        $fileName = 'data_kalender_kegiatan.csv';

        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=$fileName",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $columns = ['Tanggal', 'Waktu', 'Tempat', 'Pembahasan', 'Narasumber'];

        $callback = function () use ($data, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($data as $row) {
                fputcsv($file, [
                    $row->tanggal,
                    $row->waktu,
                    $row->tempat,
                    $row->pembahasan,
                    $row->narasumber,
                ]);
            }
            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }

    public function searchKalenderKegiatan(Request $request)
    {

        $keyword = $request->get('keyword');
        $results = KalenderKegiatan::where('tanggal', 'LIKE', '%' . $keyword . '%')
            ->orWhere('waktu', 'LIKE', '%' . $keyword . '%')
            ->orWhere('tempat', 'LIKE', '%' . $keyword . '%')
            ->orWhere('pembahasan', 'LIKE', '%' . $keyword . '%')
            ->orWhere('narasumber', 'LIKE', '%' . $keyword . '%')
            ->get();

        return response()->json($results);
    }
}
