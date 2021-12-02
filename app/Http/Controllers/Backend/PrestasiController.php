<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Alert;
use Auth;

class PrestasiController extends Controller
{
    public function index()
    {
        $data = DB::table('t_prestasi as a')
                    ->leftJoin('m_siswa as b', 'a.nis','=','b.nis')
                    ->leftJoin('m_kelas as c', 'b.kode_kelas','=','c.kode_kelas')
                    ->leftJoin('m_wali as d', 'b.no_ktp_wali','=','d.no_ktp')
                    ->select('a.*','b.*','c.nama_kelas as kelas');

        if (Auth::user()->role == '0') {
            # code...
        }elseif (Auth::user()->role == '1') {
            $data->where('b.id_user',Auth::user()->id);
        }elseif (Auth::user()->role == '2') {
            $data->where('d.id_user',Auth::user()->id);
        }

        $prestasi = $data->get();

        $siswa = DB::table('m_siswa')->get();

        return view('pages.backend.prestasi.index', compact('prestasi','siswa'));
    }

    public function create(Request $request)
    {
        $prestasi = DB::table('t_prestasi')->insert([
                    'nis' => $request->nis,
                    'kategori_prestasi' => $request->kategori,
                    'prestasi' => $request->prestasi,
                    'hadiah' => $request->hadiah,
                    'tanggal' => date('Y-m-d'),
                    'created_by' => Auth::user()->id,
                ]);

        Alert::success('Success', 'Wali Siswa Berhasil Ditambahkan!');

        return redirect()->route('prestasi-index');
    }

    public function editAjax($id)
    {
        $prestasi = DB::table('t_prestasi')->where('id', $id)->first();

        return response((array) $prestasi);
    }

    public function update(Request $request, $id)
    {
        $kelas = DB::table('t_prestasi')->where('id', $id)->update([
                    'kategori_prestasi' => $request->kategori_edit,
                    'prestasi' => $request->prestasi_edit,
                    'hadiah' => $request->hadiah_edit,
                ]);

        Alert::success('Success', 'Data Berhasil Diubah!');

        return redirect()->route('prestasi-index');
    }

    public function delete($id)
    {
        $prestasi = DB::table('t_prestasi')->where('id', $id)->delete();

        Alert::toast('Data berhasil dihapus', 'success');

        return redirect()->route('prestasi-index');
    }
}
