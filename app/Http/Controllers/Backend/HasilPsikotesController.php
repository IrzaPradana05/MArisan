<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Alert;
use Auth;

class HasilPsikotesController extends Controller
{
    public function index($id)
    {
        $data = DB::table('t_hasil_psikotes as a')
                    ->join('m_siswa as b', 'a.nis','=','b.nis')
                    ->leftJoin('m_kelas as d', 'b.kode_kelas','=','d.kode_kelas')
                    ->leftJoin('users as e', 'a.created_by','=','e.id')
                    ->leftJoin('m_wali as f', 'b.no_ktp_wali','=','f.no_ktp')
                    ->select('a.*','b.*','d.nama_kelas as kelas','e.name as penulis')
                    ->where('id_pengumuman',$id);
        if (Auth::user()->role == '0') {
            # code...
        }elseif (Auth::user()->role == '1') {
            $data->where('b.id_user',Auth::user()->id);
        }elseif (Auth::user()->role == '2') {
            $data->where('f.id_user',Auth::user()->id);
        }

        $hasil = $data->get();
        $siswa = DB::table('m_siswa')->get();
        $pengumuman = DB::table('t_pengumuman_psikotes')->where('id',$id)->first();

        return view('pages.backend.psikotes.hasil.index', compact('hasil','pengumuman','siswa'));
    }

    public function create(Request $request,$id)
    {
        $hasil = DB::table('t_hasil_psikotes')->insert([
                    'id_pengumuman' => $id,
                    'nis' => $request->nis,
                    'nilai' => $request->nilai,
                    'tanggal' => date('Y-m-d H:i:s'),
                    'created_by' => Auth::user()->id,
                ]);

        Alert::success('Success', 'Data Berhasil Ditambahkan!');

        return redirect()->route('psikotes-index', $id);
    }

    public function editAjax($id)
    {
        $hasil = DB::table('t_hasil_psikotes')->where('id', $id)->first();

        return response((array) $hasil);
    }

    public function update(Request $request, $id_pengumuman, $id)
    {
        $hasil = DB::table('t_hasil_psikotes')->where('id', $id)->update([
                    'nilai' => $request->nilai_edit,
                ]);

        $pengumuman = DB::table('t_pengumuman_psikotes')->where('id',$id_pengumuman)->first();
        $id = $pengumuman->id;

        Alert::success('Success', 'Data Berhasil Diubah!');

        return redirect()->route('psikotes-index', $id);
    }

    public function delete($id_pengumuman,$id)
    {
        $hasil = DB::table('t_hasil_psikotes')->where('id', $id)->delete();

        $pengumuman = DB::table('t_pengumuman_psikotes')->where('id',$id_pengumuman)->first();
        $id = $pengumuman->id;

        Alert::toast('Data berhasil dihapus', 'success');

        return redirect()->route('psikotes-index', $id);
    }
}
