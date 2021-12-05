<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DB;
use Auth;
use Alert;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function list_pendaftar(){
        $data = DB::table('users')->where('status_aktif',0)->get();

        // return view();
    }

    public function submit_data_diri(Request $request, $id){
        $arr_update = [
            'name' => $request->name,
            'no_hp' => $request->no_hp,
            'nik' => $request->nik,
            'jk' => $request->jk,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'surat_komitmen' => $request->surat_komitmen,
        ];
        DB::table('users')->where('id',$id)->update($arr_update);

        Alert::success('Success', 'Data Berhasil Ditambahkan!');

        // return redirect()->route();
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
