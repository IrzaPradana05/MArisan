<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Alert;
use Auth;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumuman = DB::table('t_pengumuman_psikotes as a')
                        ->join('users as b', 'a.created_by','=','b.id')
                        ->select('a.*','b.name as penulis')
                        ->get();

        if (Auth::user()->role =='1') {
            $siswa = DB::table('m_siswa')->where('id_user',Auth::user()->id)->first();
            $status_daftar = DB::table('t_peserta_psikotes')->where('nis',$siswa->nis)->first();

            return view('pages.backend.psikotes.pengumuman.index', compact('pengumuman','status_daftar'));
        }

        return view('pages.backend.psikotes.pengumuman.index', compact('pengumuman'));
    }

    public function create(Request $request)
    {
        $pengumuman = DB::table('t_pengumuman_psikotes')->insert([
                    'teks_pengumuman' => $request->teks,
                    'tanggal' => date('Y-m-d H:i:s'),
                    'created_by' => Auth::user()->id,
                ]);

        Alert::success('Success', 'Data Berhasil Ditambahkan!');

        return redirect()->route('pengumuman-index');
    }

    public function editAjax($id)
    {
        $pengumuman = DB::table('t_pengumuman_psikotes')->where('id', $id)->first();

        return response((array) $pengumuman);
    }

    public function update(Request $request, $id)
    {
        $pengumuman = DB::table('t_pengumuman_psikotes')->where('id', $id)->update([
                    'teks_pengumuman' => $request->teks_edit,
                ]);

        Alert::success('Success', 'Data Berhasil Diubah!');

        return redirect()->route('pengumuman-index');
    }

    public function delete($id)
    {
        $pengumuman = DB::table('t_pengumuman_psikotes')->where('id', $id)->delete();

        Alert::toast('Data berhasil dihapus', 'success');

        return redirect()->route('pengumuman-index');
    }

    public function create_peserta(Request $request)
    {
        $peserta = DB::table('t_peserta_psikotes')->insert([
                    'id_pengumuman' => $request->id_pengumuman,
                    'nis' => $request->nis,
                    'tanggal' => date('Y-m-d H:i:s'),
                ]);

        Alert::success('Success', 'Berhasil mendaftar tes!');

        // return redirect()->route('pengumuman-index');
    }
}
