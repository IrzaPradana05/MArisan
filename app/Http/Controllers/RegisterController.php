<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Alert;
use Hash;

class RegisterController extends Controller
{
	public function list_pendaftar(){
	    $list = DB::table('users')->where('role',2)->where('status_aktif',0)->get();

	    return view('pages.backend.konfirmasi-pendaftaran.index',compact('list'));
	}

	public function register(Request $request)

    {
        $user = DB::table('users')->insert(['username'		=>$request->username, 
                           					'role'			=>$request->role,
                             				'status_aktif'	=>4,
                              				'password'		=>Hash::make($request->password)]);

        Alert::success('Success', 'Data Berhasil Ditambahkan!');
        return redirect()->route('login');
    }

	public function form_data_diri(){
		if (Auth::user()->status_aktif==1) {
		    return redirect()->route('dashboard');
		}

	    $data = DB::table('users')->where('id',Auth::user()->id)->first();

	    return view('pages.backend.konfirmasi-pendaftaran.submit_data_diri',compact('data'));
	}

	public function submit_data_diri(Request $request, $id){
	    $fileName = DB::table('users')->where('id',$id)->first();
	    $surat_komitmen = uploadOrUpdateImage($request->file('surat_komitmen'), $fileName->surat_komitmen, $destinationPath = 'images/surat-komitmen');

	    $arr_update = [
	        'status_aktif' => 0,
	        'name' => $request->name,
	        'no_hp' => $request->no_hp,
	        'nik' => $request->nik,
	        'jk' => $request->jk,
	        'tempat_lahir' => $request->tempat_lahir,
	        'tanggal_lahir' => $request->tanggal_lahir,
	        'alamat' => $request->alamat,
	        'surat_komitmen' => $surat_komitmen,
	        'tipe_wallet' => $request->tipe_wallet,
	        'no_wallet' => $request->no_wallet,
	    ];
	    DB::table('users')->where('id',$id)->update($arr_update);

	    Alert::success('Success', 'Data Berhasil Disimpan! Silahkan tunggu Admin melakukan verifikasi data Anda.');

	    return redirect()->back();
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

	    Alert::success('Success', 'Data Berhasil Dikonfirmasi!');

	    return redirect()->back();
	}
    

}
