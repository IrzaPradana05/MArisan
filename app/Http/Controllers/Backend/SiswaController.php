<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Alert;

class SiswaController extends Controller
{
    public function index()
    {
    	$siswa = DB::table('m_siswa as a')
                    ->join('m_kelas as b', 'a.kode_kelas','=','b.kode_kelas')
                    ->leftJoin('m_wali as c', 'a.no_ktp_wali','=','c.no_ktp')
                    ->select('a.*','b.nama_kelas','c.nama as nama_wali')
                    ->get();
        $kelas = DB::table('m_kelas')->get();
        $wali = DB::table('m_wali')->get();

    	return view('pages.backend.pusat_data.siswa.index', compact('siswa','kelas','wali'));
    }

    public function create(Request $request)
    {
        $cek_wali = DB::table('m_wali')->where('no_ktp',$request->ktp)->first();
        $cek_email = DB::table('users')->where('email',$request->email)->first();
        $cek_nis = DB::table('m_siswa')->where('nis',$request->nis)->first();
        if ($cek_email) {
            Alert::warning('Maaf', 'E-mail ini sudah digunakan. Silahkan gunakan yang lain.');
            return redirect()->route('siswa-index');
        }
        if ($cek_nis) {
            Alert::warning('Maaf', 'Data NIS siswa sudah ada dalam database.');
            return redirect()->route('siswa-index');
        }
        if (!$cek_wali) {
            Alert::warning('Maaf', 'Data Wali tidak ditemukan!');
            return redirect()->route('siswa-index');
        }

        DB::table('users')->insert([
                            'name' => $request->nama,
                            'email' => $request->email,
                            'password' => bcrypt($request->nis),
                            'role' => '1',
                        ]);

        $id_user = DB::getPdo()->lastInsertId();

    	$siswa = DB::table('m_siswa')->insert([
                    'nis' => $request->nis,
    				'no_ktp_wali' => $request->ktp,
                    'id_user' => $id_user,
                    'nama' => $request->nama,
                    'kode_kelas' => $request->kode_kelas,
                    'tanggal_lahir' => $request->tanggal_lahir,
    				'jk' => $request->jk,
    			]);

        Alert::success('Success', 'Siswa berhasil ditambahkan dengan NIS sebagai password login.');

    	return redirect()->route('siswa-index');
    }

    public function editAjax($id)
    {
    	$siswa = DB::table('m_siswa')->where('nis', $id)->first();

    	return response((array) $siswa);
    }

    public function update(Request $request, $id)
    {
        $cek_wali = DB::table('m_wali')->where('no_ktp',$request->ktp_edit)->first();
        if (!$cek_wali) {
            Alert::warning('Maaf', 'Data Wali tidak ditemukan!');
            return redirect()->route('siswa-index');
        }

        $kelas = DB::table('m_siswa')->where('nis', $id)->update([
                    'nama' => $request->nama_edit,
                    'no_ktp_wali' => $request->ktp_edit,
                    'kode_kelas' => $request->kode_kelas_edit,
                    'tanggal_lahir' => $request->tanggal_lahir_edit,
                    'jk' => $request->jk_edit,
                ]);

        Alert::success('Success', 'Data Berhasil Diubah!');

        return redirect()->route('siswa-index');
    }

    public function delete($id)
    {
        $siswa = DB::table('m_siswa')->where('nis', $id)->first();
        $pelanggaran = DB::table('t_pelanggaran')->where('nis_pelanggar', $data->nis)->delete();
        $prestasi = DB::table('t_prestasi')->where('nis', $data->nis)->delete();
        $konseling = DB::table('t_konseling')->where('nis', $data->nis)->delete();
        $karir = DB::table('t_karir')->where('nis', $data->nis)->delete();
        $peserta = DB::table('t_peserta_psikotes')->where('nis', $data->nis)->delete();
        $psikotes = DB::table('t_hasil_psikotes')->where('nis', $data->nis)->delete();
        $reflin = DB::table('t_hasil_reflin')->where('nis', $data->nis)->delete();
        $pesan = DB::table('t_pesan')->where('id_user_pengirim', $siswa->id_user)->orWhere('id_user_penerima', $siswa->id_user)->delete();
        $user = DB::table('users')->where('id', $siswa->id_user)->delete();
        $siswa = DB::table('m_siswa')->where('nis', $id)->delete();

        Alert::toast('Data berhasil dihapus', 'success');

    	return redirect()->route('siswa-index');
    }
}
