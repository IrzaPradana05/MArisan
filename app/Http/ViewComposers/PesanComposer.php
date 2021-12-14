<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use DB;
use Auth;

class PesanComposer
{

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        // $data = DB::table('t_pesan as a')
        //             ->leftJoin('users as b', 'a.id_user_pengirim','=','b.id')
        //             ->leftJoin('users as c', 'a.id_user_penerima','=','c.id')
        //             ->select('a.id_user_pengirim','a.id_user_penerima','b.name as nama_pengirim','c.name as nama_penerima','a.tanggal')
        //             ->where('a.id_user_penerima',Auth::user()->id)
        //             ->where('a.status','0');
                    
        // $count = $data->count();
        // $pesan = $data->groupBy('a.id_user_pengirim','a.id_user_penerima','b.name','c.name','a.status','a.tanggal')->orderBy('a.tanggal','desc')->limit(5)->get();

        // $view->with('messages', $pesan)->with('total_messages', $count);
    }
}