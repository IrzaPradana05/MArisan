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
                    'status_arisan'=>2]);

        $slot = DB::table('t_slot_arisan')->where('id_arisan',$id)->get();
        $arr_ins_iuran=[];
        foreach ($slot as $data) {
            
            $now = strtotime(date('Y-m-d'));
            for ($i=0; $i < count($slot); $i++) {
                $tenggat = date("Y-m-d", strtotime("+".($i+1)." month", $now)); 
                $ins_iuran = [
                    'id_arisan' => $id,
                    'periode' => ($i+1),
                    'tenggat_waktu' => $tenggat,
                    'status_bayar' => 0,
                    'id_user' => $data->id_user,
                ];
                $arr_ins_iuran[] = $ins_iuran;
            }

        }
        
        DB::table('t_iuran_arisan')->insert($arr_ins_iuran);

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
        $arisan = DB::table('m_arisan as a')
                        ->leftJoin('t_slot_arisan as b', 'a.id_arisan','=','b.id_arisan')
                        ->leftJoin('users as c', 'a.created_by','=','c.id')
                        ->select('a.*','c.name as pembuat')
                        ->where('b.id_user',Auth::user()->id)
                        ->orderBy('a.created_date','desc')
                        ->orderBy('a.id_arisan','desc')
                        ->get();

        return view('pages.backend.arisan.arisan-saya', compact('arisan'));
    }

    public function tanggungan_arisan($id)
    {
        $arisan = DB::table('m_arisan')->where('id_arisan',$id)->first();
        $data_iuran = DB::table('t_iuran_arisan as a')
                        ->leftJoin('m_arisan as b', 'a.id_arisan','=','b.id_arisan')
                        ->leftJoin('users as c', 'a.id_user','=','c.id')
                        ->select('a.*','b.*','a.periode as periode','c.name as pembuat')
                        ->where('a.id_user',Auth::user()->id)
                        ->where('a.id_arisan',$id)
                        ->orderBy('a.tenggat_waktu','asc')
                        ->get();

        return view('pages.backend.arisan.tanggungan-arisan', compact('arisan','data_iuran'));
    }

    public function invoice($id)
    {
        $admin = DB::table('users')->where('role','0')->first();
        $arisan = DB::table('m_arisan as a')
                    ->leftJoin('users as b','a.created_by','=','b.id')
                    ->select('a.*','b.*','b.name as pembuat')
                    ->where('a.id_arisan', $id)->first();
        $arisan->pembuat = $admin->name;
        $arisan->tipe_wallet = $admin->tipe_wallet;
        $arisan->no_wallet = $admin->no_wallet;

        return $arisan;
    }

    public function pembayaran(Request $request, $id)
    {
        $fileName = DB::table('t_iuran_arisan')->where('id',$id)->first();
        $bukti_bayar = uploadOrUpdateImage($request->file('bukti_bayar'), $fileName->bukti_bayar, $destinationPath = 'images/bukti-bayar');

        $arisan = DB::table('t_iuran_arisan as a')
                    ->leftJoin('m_arisan as b', 'a.id_arisan','=','b.id_arisan')
                    ->select('b.created_by','b.nama_arisan','b.iuran_perbulan','a.periode')
                    ->where('id',$id)->first();

        $status_bayar = ['status_bayar'=>'2','bukti_bayar'=>$bukti_bayar];

        DB::table('t_iuran_arisan')
            ->where('id',$id)
            ->update($status_bayar);

        Alert::success('Success', 'Data pembayaran anda sedang diperiksa oleh Admin.');

        return redirect()->back();
    }

    // public function list_pembayaran_anggota($id)
    // {
    //     DB::table('t_iuran_arisan')->where('id_arisan',$id)->whereNotIn('status_bayar',[1,2,3])->get();

    //     return redirect()->back();
    // }

    public function cek_bukti_iuran($id)
    {
        $iuran = DB::table('t_iuran_arisan as a')
                    ->leftJoin('m_arisan as b', 'a.id_arisan','=','b.id_arisan')
                    ->leftJoin('users as c', 'a.id_user','=','c.id')
                    ->select('a.*','b.iuran_perbulan','c.name as pembayar','c.tipe_wallet','c.no_wallet')
                    ->where('a.id', $id)->first();

        return $iuran;
    }

    public function update_status_pembayaran(Request $request, $id)
    {
        $arisan = DB::table('t_iuran_arisan as a')
                    ->leftJoin('m_arisan as b', 'a.id_arisan','=','b.id_arisan')
                    ->leftJoin('users as c','a.id_user','=','c.id')
                    ->select('b.created_by','b.nama_arisan','b.iuran_perbulan','a.periode','a.id_arisan','a.id_user','c.name')
                    ->where('a.id',$id)->first();

        if ($request->status_bayar == '1') {
            $ins_h_keuangan = [
                'tipe' => 1,
                'catatan' => "Pembayaran iuran ".ucwords($arisan->nama_arisan)." Periode ".$arisan->periode." oleh ".ucwords($arisan->name),
                'nominal' => $arisan->iuran_perbulan,
                'created_date' => date('Y-m-d H:i:s'),
                'created_by' => Auth::user()->id,
                'id_user' => $arisan->id_user,
                'id_arisan' => $arisan->id_arisan,
            ];
            DB::table('h_keuangan')->insert($ins_h_keuangan);
        }

        DB::table('t_iuran_arisan')
            ->where('id',$id)
            ->update(['status_bayar'=>$request->status_bayar]);

        Alert::success('Success', 'Data berhasil disimpan.');

        return redirect()->back();
    }

    public function list_invoice()
    {
        $array_id_arisan = DB::table('m_arisan')->where('created_by',Auth::user()->id)->pluck('id_arisan')->toArray();

        $iuran = DB::table('t_iuran_arisan as a')
                    ->leftJoin('m_arisan as b','a.id_arisan','=','b.id_arisan')
                    ->leftJoin('users as c','a.id_user','=','c.id')
                    ->select('a.id','b.*','a.periode','c.name as pembuat')
                    ->where('a.status_bayar','2')->orderBy('a.id','desc')->get();

        return view('pages.backend.arisan.daftar-invoice', compact('iuran'));
    }

    public function detail_periode($id)
    {
        $arisan = DB::table('m_arisan')->where('id_arisan',$id)->first();

        $data_periode = [];
        for ($i=0; $i < $arisan->slot_terisi; $i++) { 
            $arr_baris = [
                'id_arisan' => $arisan->id_arisan,
                'periode' => ($i+1),
            ];
            $data_periode[] = (object) $arr_baris;
        }

        return view('pages.backend.arisan.detail-periode', compact('arisan','data_periode'));
    }

    public function status_bayar_periode($id,$periode)
    {
        $arisan = DB::table('m_arisan')->where('id_arisan',$id)->first();

        $data_iuran = DB::table('t_iuran_arisan as a')
                        ->leftJoin('m_arisan as b','a.id_arisan','=','b.id_arisan')
                        ->leftJoin('users as c','a.id_user','=','c.id')
                        ->select('a.*','c.name as pembayar',DB::raw('IF(status_bayar = 0, "Belum Bayar", IF(status_bayar = 1, "Lunas", IF(status_bayar = 2, "Diperiksa", IF(status_bayar = 3, "Tidak Valid", "")))) as nama_status_bayar'))
                        ->where('a.id_arisan',$id)
                        ->where('a.periode',$periode);

        $id_status_bayar = $data_iuran->pluck('status_bayar')->toArray();
        $id_status_bayar = array_unique($id_status_bayar);

        $data_iuran = $data_iuran->get();

        return view('pages.backend.arisan.status-bayar-periode', compact('arisan','data_iuran','id_status_bayar','id','periode'));
    }

    public function undi_pemenang($id,$periode)
    {
        $arisan = DB::table('m_arisan')->where('id_arisan',$id)->first();
        $slot_arisan = DB::table('t_slot_arisan as a')
                        ->leftJoin('users as b','a.id_user','=','b.id')
                        ->select('a.*','b.name as pemenang')
                        ->where('a.id_arisan',$id)->where('a.status_undian','0')->inRandomOrder()->first();

        DB::table('t_slot_arisan')->where('id',$slot_arisan->id)->update(['status_undian'=>2,'tgl_menang'=>date('Y-m-d H:i:s'),'periode'=>$periode]);

        Alert::info('Selamat!', ucwords($slot_arisan->pemenang).' telah menjadi pemenang periode ini!')->autoCLose(false);

        if (($arisan->periode+1) == $arisan->slot_terisi) {
            DB::table('m_arisan')->where('id_arisan',$id)->update(['periode'=>DB::raw('periode+1'),'status_arisan'=>'3']);
            return redirect()->route('arisan-index');
        }else{
            DB::table('m_arisan')->where('id_arisan',$id)->update(['periode'=>DB::raw('periode+1')]);
        }

        // return view('pages.backend.arisan.status-bayar-periode', compact('data_iuran','id_status_bayar'));
        return redirect()->route('arisan-index');
    }

    public function list_pemenang()
    {
        $query = DB::table('t_slot_arisan as a')
                        ->leftJoin('users as b','a.id_user','=','b.id')
                        ->leftJoin('m_arisan as c','a.id_arisan','=','c.id_arisan')
                        ->select('a.*','b.name as pemenang','c.nama_arisan',DB::raw('IF(status_undian = 2, "Menunggu Pembayaran", IF(status_undian = 1, "Terbayar", "")) as nama_status_undian'))
                        ->whereIn('a.status_undian',[1,2]);

        if (Auth::user()->role != '0') {
            $arr_id = DB::table('t_slot_arisan as a')
                        ->leftJoin('m_arisan as c','a.id_arisan','=','c.id_arisan')
                        ->select('a.id_arisan')->where('id_user',Auth::user()->id)->pluck('a.id_arisan')->toArray();
            $query->whereIn('a.id_arisan',$arr_id);
        }

        $pemenang = $query->get();

        return view('pages.backend.arisan.daftar-pemenang', compact('pemenang'));
    }

    public function form_transfer_pemenang($id)
    {
        $pemenang = DB::table('t_slot_arisan as a')
                        ->leftJoin('users as b','a.id_user','=','b.id')
                        ->leftJoin('m_arisan as c','a.id_arisan','=','c.id_arisan')
                        ->select('b.*','c.*',DB::raw('c.iuran_perbulan*c.slot_terisi as total_nominal'))
                        ->where('a.id',$id)->first();

        return $pemenang;
    }

    public function update_status_pemenang(Request $request, $id)
    {
        $arisan = DB::table('t_slot_arisan as a')
                    ->leftJoin('m_arisan as b', 'a.id_arisan','=','b.id_arisan')
                    ->leftJoin('users as c', 'a.id_user','=','c.id')
                    ->select('b.*','a.id_user','c.name')
                    ->where('a.id',$id)->first();

        $ins_h_keuangan = [
            'tipe' => 2,
            'catatan' => "Pembayaran dana ".ucwords($arisan->nama_arisan)." Kepada ".$arisan->name." Periode ".$arisan->periode,
            'nominal' => ($arisan->iuran_perbulan * $arisan->slot_terisi),
            'created_date' => date('Y-m-d H:i:s'),
            'created_by' => Auth::user()->id,
            'id_user' => $arisan->id_user,
            'id_arisan' => $arisan->id_arisan,
        ];
        DB::table('h_keuangan')->insert($ins_h_keuangan);

        DB::table('t_slot_arisan')
            ->where('id',$id)
            ->update(['status_undian'=>'1']);

        Alert::success('Success', 'Data berhasil disimpan.');

        return redirect()->back();
    }

    public function laporan_index()
    {
        $list_arisan = DB::table('m_arisan as a')->select('a.*','b.name as pembuat')
                        ->leftJoin('users as b', 'a.created_by','=','b.id')
                        // ->leftJoin('t_slot_arisan as c', 'a.id_arisan','=','c.id_arisan')
                        ->orderBy('a.created_date','desc')
                        ->orderBy('a.id_arisan','desc')
                        ->whereIn('a.status_arisan',[2,3]);
                        // ->get();

        if (Auth::user()->role != '0') {
            $id_arisan = DB::table('t_slot_arisan')->where('id_user',Auth::user()->id)->pluck('id_arisan')->toArray();
            $list_arisan->whereIn('a.id_arisan',$id_arisan);
        }

        $list_arisan = $list_arisan->get();

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
        // dd($arisan);

        return view('pages.backend.laporan.index', compact('arisan'));
    }

    public function laporan_keuangan($id)
    {
        $arisan = DB::table('m_arisan')->where('id_arisan',$id)->first();
        $laporan = DB::table('h_keuangan as a')
                    ->leftJoin('users as b','a.id_user','=','b.id')
                    ->leftJoin('users as c','a.created_by','=','b.id')
                    ->select('a.*','b.name as anggota','c.name as penulis', DB::raw('IF(a.tipe = 1 , "debit", "kredit") as tipe'))
                    ->where('a.id_arisan',$id)
                    ->orderBy('a.tipe','desc')
                    ->orderBy('a.created_date','desc')
                    ->get();

        return view('pages.backend.laporan.laporan', compact('laporan','arisan'));
    }

}
