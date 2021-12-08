<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Alert;
use Auth;

class ArisanController extends Controller
{
    public function index()
    {

        $arisan = DB::table('m_arisan')->get();

        return view('pages.backend.arisan.index', compact('arisan'));
    }

    public function create(Request $request)
    {
        $arisan = DB::table('m_arisan')->insert([
                    'nama_arisan'       => $request->nama_arisan,
                    'jumlah_slot'       => $request->jumlah_slot,
                    'iuran_perbulan'    => $request->iuran_perbulan,
                    'status_arisan'     => 1,
                    'created_date'      => date('Y-m-d H:i:s'),
                    'created_by'        => Auth::user()->id,
                ]);

        $id_arisan = DB::table('m_arisan')->select('id_arisan')->where('created_by', Auth::user()->id)->orderBy('created_date', 'desc')->first()->id_arisan;

        DB::table('t_slot_arisan')->insert([
                    'id_arisan'         => $id_arisan,
                    'id_user'           => Auth::user()->id,
                ]);

        Alert::success('Success', 'Data Iuran Arisan Berhasil Ditambahkan!');

        return redirect()->route('arisan-index');
    }

    public function editAjax($id)
    {
        $arisan = DB::table('m_arisan')->where('id_arisan', $id)->first();

        return $arisan;
    }

    public function update(Request $request, $id)
    {
        $arisan = DB::table('m_arisan')->where('id_arisan', $id)->update([
                    'nama_arisan'       => $request->nama_arisan,
                    'jumlah_slot'       => $request->jumlah_slot,
                    'iuran_perbulan'    => $request->iuran_perbulan,
                    'status_arisan'     => 1,
                    'created_by'        => Auth::user()->id,
                ]);

        Alert::success('Success', 'Data Berhasil Diubah!');

        return redirect()->route('arisan-index');
    }

}
