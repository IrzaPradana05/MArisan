<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Alert;

class WaliController extends Controller
{
    public function index()
    {
        $wali = DB::table('m_wali as a')
                    ->select('a.*')
                    ->get();

        return view('pages.backend.pusat_data.wali.index', compact('wali'));
    }

    public function create(Request $request)
    {
        $cek_email = DB::table('users')->where('email',$request->email)->first();
        $cek_ktp = DB::table('m_wali')->where('no_ktp',$request->no_ktp)->first();
        if ($cek_email) {
            Alert::warning('Maaf', 'E-mail ini sudah digunakan. Silahkan gunakan yang lain.');
            return redirect()->route('wali-index');
        }
        if ($cek_ktp) {
            Alert::warning('Maaf', 'Data KTP sudah ada dalam database.');
            return redirect()->route('wali-index');
        }

        DB::table('users')->insert([
                            'name' => $request->nama,
                            'email' => $request->email,
                            'password' => bcrypt($request->no_ktp),
                            'role' => '2',
                        ]);

        $id_user = DB::getPdo()->lastInsertId();

        $wali = DB::table('m_wali')->insert([
                    'id_user' => $id_user,
                    'nama' => $request->nama,
                    'email' => $request->email,
                    'no_telp' => $request->no_telp,
                    'alamat' => $request->alamat,
                    'no_ktp' => $request->no_ktp,
                ]);

        Alert::success('Success', 'Wali Siswa berhasil ditambahkan dengan No. KTP sebagai password login.');

        return redirect()->route('wali-index');
    }

    public function editAjax($id)
    {
        $wali = DB::table('m_wali')->where('id', $id)->first();

        return response((array) $wali);
    }

    public function update(Request $request, $id)
    {
        $cek_ktp = DB::table('m_wali')->where('no_ktp',$request->no_ktp)->first();
        if ($cek_ktp) {
            Alert::warning('Maaf', 'Data KTP sudah ada dalam database.');
            return redirect()->route('wali-index');
        }

        $wali = DB::table('m_wali')->where('id', $id)->update([
                    'nama' => $request->nama_edit,
                    'email' => $request->email_edit,
                    'no_telp' => $request->no_telp_edit,
                    'alamat' => $request->alamat_edit,
                    'no_ktp' => $request->no_ktp_edit,
                ]);

        Alert::success('Success', 'Data Berhasil Diubah!');

        return redirect()->route('wali-index');
    }

    public function delete($id)
    {
        $wali = DB::table('m_wali')->where('id', $id)->first();
        $user = DB::table('users')->where('id', $wali->id)->delete();
        $wali = DB::table('m_wali')->where('id', $id)->delete();

        Alert::toast('Data berhasil dihapus', 'success');

        return redirect()->route('wali-index');
    }
}
