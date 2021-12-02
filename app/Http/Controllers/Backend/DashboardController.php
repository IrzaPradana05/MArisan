<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use NXP\MathExecutor;
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        $poin_pelanggaran = DB::table('t_pelanggaran')->sum('poin_pelanggaran');
        $prestasi = DB::table('t_prestasi')->count();
        $konseling = DB::table('t_konseling')->count();
        $karir = DB::table('t_karir')->count();

    	return view('pages.backend.dashboard', compact('poin_pelanggaran','prestasi','konseling','karir'));
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
