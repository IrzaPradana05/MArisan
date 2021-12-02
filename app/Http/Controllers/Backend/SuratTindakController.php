<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Alert;
use PDF;

class SuratTindakController extends Controller
{
    public function index()
    {
    	$siswa = DB::table('m_siswa as a')
                    ->join('m_kelas as b', 'a.kode_kelas','=','b.kode_kelas')
                    ->leftJoin('t_pelanggaran as c', 'a.nis','=','c.nis_pelanggar')
                    ->select('a.nis','a.nama','b.nama_kelas','a.jk', DB::raw('SUM(c.poin_pelanggaran) as total_poin'))
                    ->groupBy('a.nis','a.nama','b.nama_kelas','a.jk')
                    ->get();

        $kelas = DB::table('m_kelas')->get();
        $wali = DB::table('m_wali')->get();

    	return view('pages.backend.surat-tindak.index', compact('siswa','kelas','wali'));
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

        Alert::success('Success', 'Siswa Berhasil Ditambahkan!');

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
        $user = DB::table('users')->where('id', $siswa->id_user)->delete();
        $siswa = DB::table('m_siswa')->where('nis', $id)->delete();

        Alert::toast('Data berhasil dihapus', 'success');

        return redirect()->route('siswa-index');
    }

    public function cetak_surat(Request $request)
    {
        $siswa = DB::table('m_siswa as a')
                    ->join('m_kelas as b', 'a.kode_kelas','=','b.kode_kelas')
                    ->leftJoin('m_wali as c', 'a.no_ktp_wali','=','c.no_ktp')
                    ->select('a.*','b.nama_kelas','c.nama as nama_wali')
                    ->where('a.nis',$request->nis)
                    ->first();

        $img = public_path('assets/img/logo/kop.jpg');
        $img = base64_encode(file_get_contents($img));
        
        if ($request->type == "panggilan") {
            $data = [
                'nama' => $siswa->nama,
                'nis' => $siswa->nis,
                'kelas' => $siswa->nama_kelas,
                'hari' => $request->hari,
                'tanggal' => $request->tanggal,
                'jam' => $request->jam,
                'tempat' => $request->tempat,
            ];

            $view = "pdf.surat-tindak.panggilan";

            $pdf = PDF::loadView($view,compact('img','data'));
        } elseif ($request->type == "skorsing") {
            $data = [
                'nama' => $siswa->nama,
                'nis' => $siswa->nis,
                'kelas' => $siswa->nama_kelas,
                'mulai_tanggal' => $request->mulai_tanggal,
                'sampai_tanggal' => $request->sampai_tanggal,
            ];

            $view = "pdf.surat-tindak.skorsing";

            $pdf = PDF::loadView($view,compact('img','data'));
        } elseif ($request->type == "dropout") {
            $data = [
                'nama' => $siswa->nama,
                'nis' => $siswa->nis,
                'kelas' => $siswa->nama_kelas,
                'tanggal' => $request->tanggal,
            ];

            $view = "pdf.surat-tindak.dropout";

            $pdf = PDF::loadView($view,compact('img','data'));
        }

        // return view($view, compact('img'));

        $pdf->setOptions([
            'isPhpEnabled' =>  true,
            'isRemoteEnabled' => true,
            'defaultFont' => 'serif',
            'isHtml5ParserEnabled' => true]);
        $pdf->setPaper('A4');

        // Alert::toast('Surat berhasil dicetak.', 'success');

        return $pdf->download();
    }
}
