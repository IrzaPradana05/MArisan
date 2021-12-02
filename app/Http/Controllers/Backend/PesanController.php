<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Alert;
use Auth;

class PesanController extends Controller
{
    public function index()
    {
        $data = DB::table('users as a')
                    ->select('a.id','a.name','a.role')
                    ->where('a.id','!=',Auth::user()->id)
                    ->groupBy('a.id','a.name','a.role');

        if (Auth::user()->role == '0') {
            $data->whereIn('a.role',['1']);
        }elseif (Auth::user()->role == '1') {
            $data->whereIn('a.role',['0']);
        }

        $kontak = $data->get();
        $pesan_baru_query = DB::table('t_pesan')->select('id_user_pengirim')->where('status','0');

        if (Auth::user()->role == '0') {
            # code...
        }elseif (Auth::user()->role == '1') {
            $pesan_baru_query->where('id_user_penerima',Auth::user()->id);
        }

        $pesan_baru = $pesan_baru_query->groupBy('id_user_pengirim')->get()->toArray();

        $data = [];
        
        foreach ($kontak as $key => $value) {
            $psn_baru = 0;
            for ($i=0; $i < count($pesan_baru); $i++) {
                if ($value->id == $pesan_baru[$i]->id_user_pengirim) {
                    $psn_baru = 1;
                }
            }

            $data[] = ['id' => $value->id,'name' => $value->name,'role' => $value->role,'pesan_baru' => $psn_baru];
        }
        $kontak = (json_decode(json_encode($data)));
        // dd($kontak);

        return view('pages.backend.pesan.index', compact('kontak','pesan_baru'));
    }

    public function chat_panel($id)
    {
        DB::table('t_pesan')->where('id_user_pengirim',$id)->where('id_user_penerima',Auth::user()->id)->where('status','0')->update(['status'=>1]);

        $pesan = DB::table('t_pesan as a')
                    ->leftJoin('users as b', 'a.id_user_pengirim','=','b.id')
                    ->leftJoin('users as c', 'a.id_user_penerima','=','c.id')
                    ->select('a.*','b.name as nama_pengirim','b.role as role','c.name as nama_penerima')
                    ->where(function($query) use ($id){
                        $query->where('id_user_pengirim',Auth::user()->id)->where('id_user_penerima',$id);
                    })
                    ->orWhere(function($query) use ($id){
                        $query->where('id_user_pengirim',$id)->where('id_user_penerima',Auth::user()->id);
                    })
                    ->orderBy('tanggal','asc')
                    ->get();
        $id_user_penerima = $id;

        return view('pages.backend.pesan.panel', compact('pesan','id_user_penerima'));
    }

    public function create(Request $request)
    {
        $pesan = DB::table('t_pesan')->insert([
                    'id_user_pengirim' => Auth::user()->id,
                    'id_user_penerima' => $request->id_user_penerima,
                    'teks' => $request->teks,
                    'tanggal' => date('Y-m-d H:i:s'),
                    'status' => 0,
                ]);

        Alert::toast('Pesan telah terkirim.', 'success');

        return redirect()->route('chat-panel',$request->id_user_penerima);
    }

    public function editAjax($id)
    {
        $karir = DB::table('t_karir')->where('id', $id)->first();

        return response((array) $karir);
    }

    public function update(Request $request, $id)
    {
        $karir = DB::table('t_karir')->where('id', $id)->update([
                    'catatan' => $request->catatan_edit,
                ]);

        Alert::success('Success', 'Data Berhasil Diubah!');

        return redirect()->route('karir-index');
    }

    public function delete($id)
    {
        $karir = DB::table('t_karir')->where('id', $id)->delete();

        Alert::toast('Data berhasil dihapus', 'success');

        return redirect()->route('karir-index');
    }
}
