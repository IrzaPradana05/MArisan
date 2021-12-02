<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kamar;
use Session;

class KamarController extends Controller
{
    public function index()
    {
    	$kamar = Kamar::where('deleted', 0)->get();

    	return view('pages.backend.pusat_data.kamar.index', compact('kamar'));
    }

    public function create(Request $request)
    {
    	$kamar = Kamar::create([
    				'nama_kamar' => $request->nama,
    				'kapasitas' => $request->kapasitas,
    				'luas' => $request->luas,
    				'fasilitas' => $request->fasilitas,
    				'tahunan' => $request->tahunan,
    				'bulanan' => $request->bulanan,
    				'mingguan' => $request->mingguan,
    				'harian' => $request->harian,
    			]);

        Session::put('notif_add', true);

    	return redirect()->route('kamar-index');
    }

    public function editAjax($id)
    {
    	$kamar = $kamar = Kamar::where('id_kamar', $id)->first();

    	return response($kamar);
    }

    public function update(Request $request, $id)
    {
    	$kamar = Kamar::where('id_kamar', $id)->update([
    				'nama_kamar' => $request->nama_edit,
    				'kapasitas' => $request->kapasitas_edit,
    				'luas' => $request->luas_edit,
    				'fasilitas' => $request->fasilitas_edit,
    				'tahunan' => $request->tahunan_edit,
    				'bulanan' => $request->bulanan_edit,
    				'mingguan' => $request->mingguan_edit,
    				'harian' => $request->harian_edit,
    			]);

        Session::put('notif_update', true);

    	return redirect()->route('kamar-index');
    }

    public function delete($id)
    {
    	$kamar = Kamar::where('id_kamar', $id)->update([
    				'deleted' => 1,
    			]);

        Session::put('notif_delete', true);

    	return redirect()->route('kamar-index');
    }
}
