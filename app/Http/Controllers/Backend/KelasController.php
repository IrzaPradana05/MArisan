<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Kamar;
use DB;
use Alert;

class KelasController extends Controller
{
    public function index()
    {
    	$kelas = DB::table('m_kelas')->get();

    	return view('pages.backend.pusat_data.kelas.index', compact('kelas'));
    }

    public function create(Request $request)
    {
    	$kelas = DB::table('m_kelas')->insert([
    				'kode_kelas' => $request->kode_kelas,
    				'nama_kelas' => $request->nama_kelas,
    			]);

        Alert::success('Success', 'Kelas Berhasil Ditambahkan!');

    	return redirect()->route('kelas-index');
    }

    public function editAjax($id)
    {
    	$kelas = DB::table('m_kelas')->where('id', $id)->first();

    	return response((array) $kelas);
    }

    public function update(Request $request, $id)
    {
        $kelas = DB::table('m_kelas')->where('id', $id)->update([
                    'kode_kelas' => $request->kode_kelas_edit,
                    'nama_kelas' => $request->nama_kelas_edit,
                ]);

        Alert::success('Success', 'Data Berhasil Diubah!');

        return redirect()->route('kelas-index');
    }

    public function delete($id)
    {
    	$kelas = DB::table('m_kelas')->where('id', $id)->delete();

        Alert::toast('Data berhasil dihapus', 'success');

    	return redirect()->route('kelas-index');
    }
}
