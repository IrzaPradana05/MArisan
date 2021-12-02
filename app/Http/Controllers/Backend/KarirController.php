<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Alert;
use Auth;

class KarirController extends Controller
{
    public function index()
    {
        $data = DB::table('t_karir as a')
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

        $karir = $data->get();

        $siswa = DB::table('m_siswa')->get();

        return view('pages.backend.karir.index', compact('karir','siswa'));
    }

    public function create(Request $request)
    {
        $karir = DB::table('t_karir')->insert([
                    'nis' => $request->nis,
                    'catatan' => $request->catatan,
                    'tanggal' => date('Y-m-d H:i:s'),
                    'created_by' => Auth::user()->id,
                ]);

        Alert::success('Success', 'Data Berhasil Ditambahkan!');

        return redirect()->route('karir-index');
    }

    public function editAjax($id)
    {
        $karir = DB::table('t_karir')->where('id', $id)->first();

        return response((array) $karir);
    }

    public function update(Request $request, $id)
    {
        $karir = DB::table('t_karir')->where('id', $id)->update([
                    'catatan' => $request->catatan_edit,
                ]);

        Alert::success('Success', 'Data Berhasil Diubah!');

        return redirect()->route('karir-index');
    }

    public function delete($id)
    {
        $karir = DB::table('t_karir')->where('id', $id)->delete();

        Alert::toast('Data berhasil dihapus', 'success');

        return redirect()->route('karir-index');
    }
}
