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

        $list_arisan = DB::table('m_arisan as a')->select('a.*','b.name as pembuat')
                        ->leftJoin('users as b', 'a.created_by','=','b.id')
                        ->orderBy('a.created_date','desc')
                        ->orderBy('a.id_arisan','desc')
                        ->where('a.created_by',Auth::user()->id)
                        ->get();

        $list_slot = DB::table('t_slot_arisan as a')->select('a.*')->get();
        $data = [];
        foreach ($list_arisan as $arisan) {
            $arr_slot = [];
            foreach ($list_slot as $slot) {
                if ($slot->id_arisan == $arisan->id_arisan) {
                    $arr_slot[] = $slot->id_user;
                }
            }
            $arisan->list_id_user = $arr_slot;
            $data[] = $arisan;
        }
        $arisan = (object) $data;

        return view('pages.backend.arisan.index', compact('arisan'));
    }

    public function create(Request $request)
    {
        $arisan = DB::table('m_arisan')->insert([
                    'nama_arisan'       => $request->nama_arisan,
                    'jumlah_slot'       => $request->jumlah_slot,
                    'slot_terisi'       => 1,
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
                    // 'nama_arisan'       => $request->nama_arisan,
                    // 'jumlah_slot'       => $request->jumlah_slot,
                    // 'iuran_perbulan'    => $request->iuran_perbulan,
                    'status_arisan'     => 1,
                    // 'created_by'        => Auth::user()->id,
                ]);

        Alert::success('Success', 'Data Berhasil Diubah!');

        return redirect()->route('arisan-index');
    }

    public function update_batal(Request $request, $id)
    {
        $arisan = DB::table('m_arisan')->where('id_arisan', $id)->update([
                    'status_arisan'     => 0,
                ]);

        DB::table('t_slot_arisan')->where('id_arisan',$id)->delete();

        Alert::success('Success', 'Arisan telah dibatalkan!');

        return redirect()->route('arisan-index');
    }

    public function update_aktif(Request $request, $id)
    {
        $arisan = DB::table('m_arisan')->where('id_arisan', $id)->update([
                    'status_arisan'     => 2,
                ]);

        Alert::success('Success', 'Arisan telah berlangsung!');

        return redirect()->route('arisan-index');
    }

    public function update_selesai(Request $request, $id)
    {
        $arisan = DB::table('m_arisan')->where('id_arisan', $id)->update([
                    'status_arisan'     => 3,
                ]);

        Alert::success('Success', 'Arisan telah selesai!');

        return redirect()->route('arisan-index');
    }

    public function join_arisan(Request $request, $id)
    {
        $cek_arisan = DB::table('m_arisan')->where('id_arisan',$id)->first();
        if ($cek_arisan->slot_terisi < $cek_arisan->jumlah_slot) {

            DB::table('t_slot_arisan')->insert([
                        'id_arisan'         => $id,
                        'id_user'           => Auth::user()->id,
                    ]);

            DB::table('m_arisan')->where('id_arisan',$id)->update([
                        'slot_terisi'         => DB::raw('slot_terisi+1'),
                    ]);

            Alert::success('Success', 'Berhasil bergabung dalam arisan!');

            return redirect()->back();
        }else{
            Alert::warning('Maaf', 'Slot arisan sudah penuh!');

            return redirect()->back();
        }

    }

    public function arisan_saya()
    {
        $arisan = DB::table('t_slot_arisan as a')
                        ->leftJoin('m_arisan as b', 'a.id_arisan','=','b.id_arisan')
                        ->leftJoin('users as c', 'b.created_by','=','c.id')
                        ->select('b.*','c.name as pembuat')
                        ->where('a.id_user',Auth::user()->id)
                        ->orderBy('b.created_date','desc')
                        ->orderBy('b.id_arisan','desc')
                        ->get();

        return view('pages.backend.arisan.arisan-saya', compact('arisan'));
    }

}
