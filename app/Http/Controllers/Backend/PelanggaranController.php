<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Alert;
use Auth;

class PelanggaranController extends Controller
{
    public function index()
    {
        $data = DB::table('t_pelanggaran as a')
                    ->leftJoin('m_siswa as b', 'a.nis_pelanggar','=','b.nis')
                    ->leftJoin('users as c', 'a.created_by','=','c.id')
                    ->leftJoin('m_kelas as d', 'b.kode_kelas','=','d.kode_kelas')
                    ->leftJoin('m_wali as e', 'b.no_ktp_wali','=','e.no_ktp')
                    ->select('a.*','b.*','c.name as penulis','d.nama_kelas as kelas');
        if (Auth::user()->role == '0') {
            
        }elseif (Auth::user()->role == '1') {
            $data->where('b.id_user',Auth::user()->id);
        }elseif (Auth::user()->role == '2') {
            $data->where('e.id_user',Auth::user()->id);
        }

        $pelanggaran = $data->get();

        $siswa = DB::table('m_siswa')->get();

        return view('pages.backend.pelanggaran.index', compact('pelanggaran','siswa'));
    }

    public function create(Request $request)
    {
        $pelanggaran = DB::table('t_pelanggaran')->insert([
                    'nis_pelanggar' => $request->nis,
                    'kategori_pelanggaran' => $request->kategori,
                    'poin_pelanggaran' => $request->poin,
                    'pelanggaran' => $request->pelanggaran,
                    'sanksi' => $request->sanksi,
                    'tanggal' => date('Y-m-d H:i:s'),
                    'created_by' => Auth::user()->id,
                ]);

        Alert::success('Success', 'Wali Siswa Berhasil Ditambahkan!');

        return redirect()->route('pelanggaran-index');
    }

    public function editAjax($id)
    {
        $pelanggaran = DB::table('t_pelanggaran')->where('id', $id)->first();

        return response((array) $pelanggaran);
    }

    public function update(Request $request, $id)
    {
        $kelas = DB::table('t_pelanggaran')->where('id', $id)->update([
                    'kategori_pelanggaran' => $request->kategori_edit,
                    'poin_pelanggaran' => $request->poin_edit,
                    'pelanggaran' => $request->pelanggaran_edit,
                    'sanksi' => $request->sanksi_edit,
                ]);

        Alert::success('Success', 'Data Berhasil Diubah!');

        return redirect()->route('pelanggaran-index');
    }

    public function delete($id)
    {
        $pelanggaran = DB::table('t_pelanggaran')->where('id', $id)->delete();

        Alert::toast('Data berhasil dihapus', 'success');

        return redirect()->route('pelanggaran-index');
    }
}
