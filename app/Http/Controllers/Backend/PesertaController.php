<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Alert;
use Auth;

class PesertaController extends Controller
{
    public function index($id)
    {
        $peserta = DB::table('t_peserta_psikotes as a')
                    ->join('m_siswa as b', 'a.nis','=','b.nis')
                    ->leftJoin('m_kelas as d', 'b.kode_kelas','=','d.kode_kelas')
                    ->select('a.*','b.*','d.nama_kelas as kelas')
                    ->where('id_pengumuman',$id)->get();
        $siswa = DB::table('m_siswa')->get();
        $pengumuman = DB::table('t_pengumuman_psikotes')->where('id',$id)->first();

        return view('pages.backend.psikotes.peserta.index', compact('peserta','pengumuman','siswa'));
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

    public function daftar(Request $request,$id)
    {
        $siswa = DB::table('m_siswa')->where('id_user',Auth::user()->id)->first();
        $hasil = DB::table('t_peserta_psikotes')->insert([
                    'id_pengumuman' => $id,
                    'nis' => $siswa->nis,
                    'tanggal' => date('Y-m-d H:i:s'),
                ]);

        Alert::success('Success', 'Berhasil mendaftarkan diri pada tes!');

        return redirect()->route('pengumuman-index');
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
