<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Alert;

class RegisterController extends Controller
{
	public function list_pendaftar(){
	    $list = DB::table('users')->where('status_aktif',0)->get();

	    return view('pages.backend.konfirmasi-pendaftaran.index',compact('list'));
	}

	public function submit_data_diri(Request $request, $id){
	    $fileName = DB::table('users')->where('id',$id)->first('surat_komitmen');
	    $surat_komitmen = $this->uploadOrUpdateThumbnail($request->surat_komitmen, $fileName, $destinationPath = 'images/surat-komitmen/');

	    $arr_update = [
	        'name' => $request->name,
	        'no_hp' => $request->no_hp,
	        'nik' => $request->nik,
	        'jk' => $request->jk,
	        'tempat_lahir' => $request->tempat_lahir,
	        'tanggal_lahir' => $request->tanggal_lahir,
	        'alamat' => $request->alamat,
	        'surat_komitmen' => $surat_komitmen,
	    ];
	    DB::table('users')->where('id',$id)->update($arr_update);

	    Alert::success('Success', 'Data Berhasil Ditambahkan!');

	    // return redirect()->route();
	}

	public function edit_status_pendaftar($id){
	    $data = DB::table('users')->where('id',$id)->first();

	    return $data;
	}

	public function update_status_pendaftar(Request $request, $id){
	    $arr_update = [
	        'status_aktif' => $request->status_aktif,
	    ];
	    DB::table('users')->where('id',$id)->update($arr_update);

	    Alert::success('Success', 'Data Berhasil Ditambahkan!');

	    // return redirect()->route();
	}
    

}