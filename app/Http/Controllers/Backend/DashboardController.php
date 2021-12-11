<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use NXP\MathExecutor;
use DB;
use Auth;
use Alert;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->status_aktif==0 || Auth::user()->status_aktif==4) {
            return redirect()->route('form-data-diri');
        }elseif(Auth::user()->status_aktif==2) {
            Alert::warning('Warning', 'Data tidak valid! Silahkan periksa dan isi kembali data Anda dengan benar.');
            return redirect()->route('form-data-diri');
        }

        $list_arisan = DB::table('m_arisan as a')->select('a.*','b.name as pembuat')
                        ->leftJoin('users as b', 'a.created_by','=','b.id')
                        ->orderBy('a.created_date','desc')
                        ->orderBy('a.id_arisan','desc')
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
        $list_arisan = (object) $data;

        $jumlah_arisan = DB::table('m_arisan')->count();
        $kredit = DB::table('h_keuangan')->where('tipe','1')->sum('nominal');
        $debit = DB::table('h_keuangan')->where('tipe','2')->sum('nominal');

    	return view('pages.backend.dashboard', compact('jumlah_arisan','kredit','debit','list_arisan'));
    }

}
