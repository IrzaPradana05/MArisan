<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Alert;
use Auth;

class AdminController extends Controller
{
    public function edit_profil()
    {
    	$data = DB::table('users')->where('id', Auth::user()->id)->first();

    	return view('pages.backend.profil.profil', compact('data'));
    }

    public function submit_data_profil(Request $request, $id){

        $arr_update = [
            'name' => $request->name,
            'no_hp' => $request->no_hp,
            'nik' => $request->nik,
            'jk' => $request->jk,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'tipe_wallet' => $request->tipe_wallet,
            'no_wallet' => $request->no_wallet,
        ];
        DB::table('users')->where('id',$id)->update($arr_update);

        Alert::success('Success', 'Data Berhasil Disimpan!');

        return redirect()->back();
    }
}
