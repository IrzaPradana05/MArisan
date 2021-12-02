<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Alert;
use Auth;

class HasilReflinController extends Controller
{
    public function index()
    {
        $data = DB::table('t_hasil_reflin as a')
                    ->join('m_siswa as b', 'a.nis','=','b.nis')
                    ->leftJoin('m_kelas as d', 'b.kode_kelas','=','d.kode_kelas')
                    ->leftJoin('users as e', 'a.created_by','=','e.id')
                    ->leftJoin('m_wali as f', 'b.no_ktp_wali','=','f.no_ktp')
                    ->select('a.*','b.*','d.nama_kelas as kelas','e.name as penulis');
        if (Auth::user()->role == '0') {
            # code...
        }elseif (Auth::user()->role == '1') {
            $data->where('b.id_user',Auth::user()->id);
        }elseif (Auth::user()->role == '2') {
            $data->where('f.id_user',Auth::user()->id);
        }

        $hasil = $data->get();
        $siswa = DB::table('m_siswa')->get();

        return view('pages.backend.reflin.index', compact('hasil','siswa'));
    }

    public function create(Request $request)
    {
        $hasil = DB::table('t_hasil_reflin')->insert([
                    'nis' => $request->nis,
                    'nilai' => $request->nilai,
                    'tanggal' => date('Y-m-d H:i:s'),
                    'created_by' => Auth::user()->id,
                ]);

        Alert::success('Success', 'Data Berhasil Ditambahkan!');

        return redirect()->route('reflin-index');
    }

    public function editAjax($id)
    {
        $hasil = DB::table('t_hasil_reflin')->where('id', $id)->first();

        return response((array) $hasil);
    }

    public function update(Request $request, $id)
    {
        $hasil = DB::table('t_hasil_reflin')->where('id', $id)->update([
                    'nilai' => $request->nilai_edit,
                ]);

        Alert::success('Success', 'Data Berhasil Diubah!');

        return redirect()->route('reflin-index');
    }

    public function delete($id)
    {
        $hasil = DB::table('t_hasil_reflin')->where('id', $id)->delete();

        Alert::toast('Data berhasil dihapus', 'success');

        return redirect()->route('reflin-index');
    }
}
