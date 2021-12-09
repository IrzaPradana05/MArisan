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

        $poin_pelanggaran = DB::table('t_pelanggaran')->sum('poin_pelanggaran');
        $prestasi = DB::table('t_prestasi')->count();
        $konseling = DB::table('t_konseling')->count();
        $karir = DB::table('t_karir')->count();

    	return view('pages.backend.dashboard', compact('poin_pelanggaran','prestasi','konseling','karir','list_arisan'));
    }

    public function executor()
    {
        $arr_data =[
            'A1' => "6",
            'B1' => "8",
            'C1' => "12",
            '=' => "=="
        ];

        //$formula = '(A1 - (A1+B1))^C1 + sin(C1)';
        $a = '(A1 - (A1+B1))^C1 + sin(C1)';
        $b = '(A1*C1)^3';
        //$formula_asli = 'if(1=1,A1,B1)';
        // $formula_asli = 'if(1=2,round('.$a.'),'.$b.')';
        $formula_asli = 'ceil(9.1)';
        $formula = $this->replaceFormula($formula_asli);
        return $this->proses_formula($arr_data,$formula);   // 68719476735.463 -> hasilnya
    }

    public function replaceFormula($formula){
        $res = "";
        $res = str_replace("=", "==", $formula);
        return $res;
    }

    public function proses_formula($array,$formula)
    {
        $executor = new MathExecutor();
        
        foreach ($array as $key => $value) {
            $executor->setVar($key, $value);
        }
        // ->setVar('B1', $array['B1'])->setVar('C1', $array['C1']);
        
		return $executor->execute($formula);

  //   	$A = $executor->execute('1 + 2 * (2 - (4+10))^2 + tan(10)');
  //   	$B = $executor->execute('1 + 7 / (2 - (4+0))^2 + cos(10)');

		// if ($A > $B) {
		// 	return 'A lebih besar dari B';
		// }else{
		// 	return 'B lebih besar dari A';
		// }
    }
}
