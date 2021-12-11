<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Alert;
use Auth;

class AdminController extends Controller
{
    public function index()
    {
        $user = DB::table('users')->where('role','0')->get();

    	return view('pages.backend.pusat_data.admin.index', compact('user'));
    }

    public function create(Request $request)
    {
        $cek_email = DB::table('users')->where('email',$request->email)->first();
        if ($cek_email) {
            Alert::warning('Maaf', 'E-mail ini sudah digunakan. Silahkan gunakan yang lain.');
            return redirect()->route('wali-index');
        }

        DB::table('users')->insert([
                            'name' => $request->nama,
                            'email' => $request->email,
                            'password' => bcrypt($request->password),
                            'role' => '0',
                        ]);

        Alert::success('Success', 'Admin BK Berhasil Ditambahkan!');

    	return redirect()->route('admin-index');
    }

    public function editAjax($id)
    {
        $user = DB::table('users')->where('id', $id)->first();

        return response((array) $user);
    }

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

    public function update(Request $request, $id)
    {
        $cek_email = DB::table('users')->where('email',$request->email)->first();
        if ($cek_email) {
            Alert::warning('Maaf', 'E-mail ini sudah digunakan. Silahkan gunakan yang lain.');
            return redirect()->route('wali-index');
        }
        
        $user = DB::table('users')->where('id', $id)->update([
                    'name' => $request->nama_edit,
                    'password' => bcrypt($request->password_edit),
                ]);

        Alert::success('Success', 'Data Berhasil Diubah!');

        return redirect()->route('admin-index');
    }

    public function delete($id)
    {
        $user = DB::table('users')->where('id', $id)->delete();

        Alert::toast('Data berhasil dihapus', 'success');

    	return redirect()->route('admin-index');
    }
}
