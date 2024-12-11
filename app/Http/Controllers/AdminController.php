<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function viewDataMahasiswa(Request $request, Mahasiswa $mahasiswa)
    {
        $this->authorize('viewDataMahasiswa', $mahasiswa);
        $mahasiswa = Mahasiswa::all();
        return view('informasi.admin.mahasiswa.mahasiswa', compact('mahasiswa'));
    }

    public function viewDetailDataMahasiswa($user_id, Mahasiswa $mahasiswa)
    {
        $this->authorize('viewDetailDataMahasiswa', $mahasiswa);
        $mahasiswa = Mahasiswa::where('user_id', $user_id)->first();
        return view('informasi.admin.mahasiswa.detail-mahasiswa', ['mahasiswa' => $mahasiswa]);
    }

    public function updateDataMahasiswa(Request $request, Mahasiswa $mahasiswa)
    {

        $this->authorize('updateDataMahasiswa', $mahasiswa);

        $validator = Validator::make($request->all(), [
            'email' => 'email|unique:mahasiswa,email,',
            'npm' => 'unique:mahasiswa,npm,',
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
        $user_id = $request->user_id;
        $mahasiswa = Mahasiswa::where('user_id', $user_id)->first();
        if ($mahasiswa) {
            $mahasiswa->nama_lengkap = $request->namaLengkap;
            if ($request->npm !== null) {
                $mahasiswa->npm = $request->npm;
            }
            $mahasiswa->fakultas = $request->fakultas;
            $mahasiswa->prodi = $request->prodi;
            if ($request->email !== null) {
                $mahasiswa->email = $request->email;
            }
            $mahasiswa->nomer_whatsapp = $request->nomerWhatsapp;

            $mahasiswa->update();

            return response()->json(['msg' => 'Data Mahasiswa Berhasil Diubah.'], 200);
        }
    }

    public function deleteDataMahasiswa($id, Mahasiswa $mahasiswa)
    {

        $this->authorize('deleteDataMahasiswa', $mahasiswa);

        DB::beginTransaction();
        try {
            Mahasiswa::where('user_id', $id)->delete();

            User::where('id', $id)->delete();

            DB::commit();
            return response()->json(['message' => 'Data DPL Berhasil Dihapus.'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function searchDataMahasiswa(Request $request, Mahasiswa $mahasiswa)
    {

        $this->authorize('searchDataMahasiswa', $mahasiswa);

        $keyword = $request->get('keyword');
        $results = Mahasiswa::where('nama_lengkap', 'LIKE', '%' . $keyword . '%')
            ->orWhere('npm', 'LIKE', '%' . $keyword . '%')
            ->orWhere('fakultas', 'LIKE', '%' . $keyword . '%')
            ->orWhere('prodi', 'LIKE', '%' . $keyword . '%')
            ->get();

        return response()->json($results);
    }

    public function downloadDataMahasiswa(Mahasiswa $mahasiswa)
    {

        $this->authorize('downloadDataMahasiswa', $mahasiswa);

        $data = Mahasiswa::all();

        $fileName = 'data_mahasiswa.csv';

        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=$fileName",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $columns = ['Nama Lengkap', 'NPM', 'Fakultas', 'Prodi', 'Email', 'Nomer Whatsapp', 'Status'];

        $callback = function () use ($data, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($data as $row) {
                fputcsv($file, [
                    $row->nama_lengkap,
                    $row->npm,
                    $row->gelar,
                    $row->fakultas,
                    $row->prodi,
                    $row->email,
                    $row->nomer_whatsapp,
                    $row->status,
                ]);
            }
            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }
}
