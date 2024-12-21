<?php

namespace App\Http\Controllers;

use App\Models\Dpl;
use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\KelompokKKN;
use Illuminate\Http\Request;
use App\Models\KelompokMahasiswa;
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

    public function viewDataDpl(Request $request, Dpl $dpl)
    {
        $this->authorize('viewDataDpl', $dpl);
        $dpl = Dpl::all();
        return view('informasi.admin.dpl.dpl', compact('dpl'));
    }

    public function viewDetailDataDpl($user_id, Dpl $dpl)
    {
        $this->authorize('viewDetailDataDpl', $dpl);
        $dpl = Dpl::where('user_id', $user_id)->first();
        return view('informasi.admin.dpl.detail-dpl', ['dpl' => $dpl]);
    }

    public function updateDataDpl(Request $request, Dpl $dpl)
    {

        $this->authorize('updateDataDpl', $dpl);

        $validator = Validator::make($request->all(), [
            'email' => 'email|unique:dpl,email,',
            'nip' => 'unique:dpl,nip,',
        ]);

        if ($validator->fails()) {
            if ($validator->errors()->has('email')) {
                return response()->json(['message' => 'Email sudah digunakan!'], 422);
            }
            if ($validator->errors()->has('nip')) {
                return response()->json(['message' => 'NIP sudah digunakan!'], 422);
            }
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $user_id = $request->user_id;
        $dpl = Dpl::where('user_id', $user_id)->first();
        if ($dpl) {
            $dpl->nama_lengkap = $request->namaLengkap;
            if ($request->nip !== null) {
                $dpl->nip = $request->nip;
            }
            $dpl->gelar = $request->gelar;
            $dpl->fakultas = $request->fakultas;
            $dpl->prodi = $request->prodi;
            $dpl->nama_bank = $request->namaBank;
            $dpl->nomer_rekening = $request->nomerRekening;
            if ($request->email !== null) {
                $dpl->email = $request->email;
            }
            $dpl->nomer_whatsapp = $request->nomerWhatsapp;

            $dpl->update();

            return response()->json(['msg' => 'Data Dpl Berhasil Diubah.'], 200);
        }
    }

    public function deleteDataDpl($id, Dpl $dpl)
    {

        $this->authorize('deleteDataDpl', $dpl);

        DB::beginTransaction();
        try {
            Dpl::where('user_id', $id)->delete();

            User::where('id', $id)->delete();

            DB::commit();
            return response()->json(['message' => 'Data DPL Berhasil Dihapus.'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function searchDataDpl(Request $request, Dpl $dpl)
    {

        $this->authorize('searchDataDpl', $dpl);

        $keyword = $request->get('keyword');
        $results = Dpl::where('nama_lengkap', 'LIKE', '%' . $keyword . '%')
            ->orWhere('nip', 'LIKE', '%' . $keyword . '%')
            ->orWhere('fakultas', 'LIKE', '%' . $keyword . '%')
            ->orWhere('prodi', 'LIKE', '%' . $keyword . '%')
            ->get();

        return response()->json($results);
    }

    public function downloadDataDpl(Dpl $dpl)
    {

        $this->authorize('downloadDataDpl', $dpl);
        $data = Dpl::all();


        $fileName = 'data_dpl.csv';

        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=$fileName",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $columns = ['Nama Lengkap', 'NIP', 'Gelar', 'Fakultas', 'Prodi', 'Bank', 'Nomer Rekening', 'Email', 'Nomer Whatsapp', 'Status'];

        $callback = function () use ($data, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($data as $row) {
                fputcsv($file, [
                    $row->nama_lengkap,
                    $row->nip,
                    $row->gelar,
                    $row->fakultas,
                    $row->prodi,
                    $row->nama_bank,
                    $row->nomer_rekening,
                    $row->email,
                    $row->nomer_whatsapp,
                    $row->status,
                ]);
            }
            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }

    public function viewDataKelompok()
    {
        $kelompok = KelompokKKN::with(['dpl'])->withCount('kelompokMahasiswa')->get();
        return view('informasi.admin.kelompok.kelompok', compact('kelompok'));
    }


    public function viewCreateDataKelompok()
    {
        $dpls = Dpl::where('status', 'belum terdaftar')->get();
        $mahasiswaFK = Mahasiswa::where('status', 'diproses')
            ->where('fakultas', 'Fakultas Kedokteran')
            ->get();
        $mahasiswaFKG = Mahasiswa::where('status', 'diproses')
            ->where('fakultas', 'Fakultas Kedokteran Gigi')
            ->get();
        $mahasiswaPsikologi = Mahasiswa::where('status', 'diproses')
            ->where('fakultas', 'Fakultas Psikologi')
            ->get();
        $mahasiswaFEB = Mahasiswa::where('status', 'diproses')
            ->where('fakultas', 'Fakultas Ekonomi dan Bisnis')
            ->get();
        $mahasiswaFTI = Mahasiswa::where('status', 'diproses')
            ->where('fakultas', 'Fakultas Teknologi Informasi')
            ->get();
        $mahasiswaFH = Mahasiswa::where('status', 'diproses')
            ->where('fakultas', 'Fakultas Hukum')
            ->get();

        return view('informasi.admin.kelompok.buat-kelompok', compact(
            'dpls',
            'mahasiswaFK',
            'mahasiswaFKG',
            'mahasiswaPsikologi',
            'mahasiswaFEB',
            'mahasiswaFTI',
            'mahasiswaFH',
        ));
    }

    public function createKelompokKKN(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_kelompok' => 'unique:kelompok_kkn,nama_kelompok,',
        ]);

        if ($validator->fails()) {
            if ($validator->errors()->has('nama_kelompok')) {
                return response()->json(['message' => 'Nama kelompok telah digunakan!'], 422);
            }
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $kelompokKKN = KelompokKKN::create([
            'nama_kelompok' => $request->nama_kelompok,
            'lokasi' => $request->lokasi,
            'dpl_id' => $request->dpl_id,
        ]);

        $dpl = Dpl::find($request->dpl_id);
        $dpl->update([
            'status' => "terdaftar",
        ]);

        return response()->json([
            'success' => 'Buat kelompok berhasil.',
            'kelompok_kkn_id' => $kelompokKKN->id,
        ], 200);
    }

    public function addMahasiswaToKelompokKKN(Request $request)
    {
        $kelompokMahasiswa = KelompokMahasiswa::create([
            'kelompok_kkn_id' => $request->kelompok_kkn_id,
            'mahasiswa_id' => $request->mahasiswa_id,
        ]);
        $mahasiswa = Mahasiswa::find($request->mahasiswa_id);
        $mahasiswa->update([
            'status' => "terdaftar",
        ]);
        return response()->json(['success' => 'Buat kelompok berhasil.'], 200);
    }

    public function viewDetailDataKelompok($id)
    {
        $dpls = Dpl::where('status', 'belum terdaftar')->get();
        $mahasiswa = Mahasiswa::where('status', 'diproses')->get();
        $kelompokKKN = KelompokKKN::where('id', $id)->first();
        $kelompokMahasiswa = KelompokMahasiswa::where('kelompok_kkn_id', $id)->get();

        return view('informasi.admin.kelompok.detail-kelompok', compact(
            'mahasiswa',
            'kelompokKKN',
            'kelompokMahasiswa',
            'dpls'
        ));
    }

    public function editDataKelompokKKN(Request $request, $id)
    {
        $kelompokKKN = KelompokKKN::find($id);

        $validator = Validator::make($request->all(), [
            'kelompok_kkn' => 'unique:kelompok_kkn,nama_kelompok,' . $kelompokKKN->id . ',id'

        ]);

        if ($validator->fails()) {
            if ($validator->errors()->has('nama_kelompok')) {
                return response()->json(['message' => 'Nama kelompok telah digunakan!'], 422);
            }
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $kelompokKKN->update([
            'nama_kelompok' => $request->nama_kelompok,
            'lokasi' => $request->lokasi,
        ]);

        return response()->json(['success' => 'Kelompok berhasil diubah.'], 200);
    }

    public function searchDataKelompokMahasiswa(Request $request, Mahasiswa $mahasiswa)
    {

        $keyword = $request->get('keyword');
        $results = Mahasiswa::where('status', 'diproses')
        ->where(function ($query) use ($keyword) {
            $query->where('nama_lengkap', 'LIKE', '%' . $keyword . '%')
                ->orWhere('npm', 'LIKE', '%' . $keyword . '%')
                ->orWhere('fakultas', 'LIKE', '%' . $keyword . '%')
                ->orWhere('prodi', 'LIKE', '%' . $keyword . '%');
        })
        ->get();

    return response()->json($results);
    }
}
