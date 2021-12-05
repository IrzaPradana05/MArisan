<?php
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;

use LaravelFCM\Facades\FCM;

use App\LogUser;
use App\Jobs\SendEmail;

function uploadOrUpdateImage($request, $fileName = null)
{
    $destinationPath = 'images/article/thumbnail/'.\Auth::user()->web;

    if(!is_dir(public_path($destinationPath))) {
        mkdir(public_path($destinationPath), 0777, true);
    }

    if($request->hasFile('thumbnail')) {
        if($fileName) {
            if(file_exists(public_path($fileName))) {
                \unlink(public_path($fileName));
            }
        }

        $file = $request->file('thumbnail');
        $fileName = time().'.'.$file->getClientOriginalExtension();
        $fileExtension = \File::extension($fileName);
        $fileNameWithExtension = $fileName.'.'.$fileExtension;
        // $file->move($destinationPath, $fileNameWithExtension);
        $img = Image::make($file->getRealPath());
        $img->save(public_path($destinationPath).'/'.$fileNameWithExtension);

        $fileName = $destinationPath.'/'.$fileNameWithExtension;
    }

    return $fileName;
}

function can_akses($kode = null) {

  $data_akses   =   DB::table('m_role as a')
                    ->select('a.kode')
                    ->join('map_user_role as b','a.id_role','=','b.id_role')
                    ->where('b.id_username',Auth::user()->id_username)->get();

  // dd($data_akses);

  $datah = [];

  foreach ($data_akses as $key => $value) {

    array_push($datah, $value->kode);

  }

  // if ($ci->session->userdata("is_admin") || in_array($kode, $ci->session->userdata("can_akses"))) {
  if (session('is_admin') == 1 || in_array($kode, $datah)) {

    return true;

  } else {

    return false;

  }

}

function can_akses_wo_admin($kode = null) {

  $data_akses   =   DB::table('m_role as a')
                    ->select('a.kode')
                    ->join('map_user_role as b','a.id_role','=','b.id_role')
                    ->where('b.id_username',Auth::user()->id_username)->get();

  // dd($data_akses);

  $datah = [];

  foreach ($data_akses as $key => $value) {

    array_push($datah, $value->kode);

  }

  // if ($ci->session->userdata("is_admin") || in_array($kode, $ci->session->userdata("can_akses"))) {
  if (in_array($kode, $datah)) {

    return true;

  } else {

    return false;

  }

}

function can_akses_mca($id_portal_modul,$kode = null) {

  if ($kode == "maker") {

    $kode = 1;

  } elseif ($kode == "checker") {

    $kode = 2;

  } elseif ($kode == "approver") {

    $kode = 3;

  }

  $data_akses   =   DB::table('map_modul_user as a')
                    ->select('a.id_username')
                    ->where('akses',$kode)->where('id_portal_modul',$id_portal_modul)->get();

  // dd($data_akses);

  $datah = [];

  foreach ($data_akses as $key => $value) {

    array_push($datah, $value->id_username);

  }

  // if ($ci->session->userdata("is_admin") || in_array($kode, $ci->session->userdata("can_akses"))) {
  if (session('is_admin') == 1 || in_array(Auth::user()->id_username, $datah)) {

    return true;

  } else {

    return false;

  }

}

function format_tanggal($tgl, $tampil_hari=true, $with_menit = true){
  if ($tgl == '0000-00-00 00:00:00' || is_null($tgl) || $tgl == "" || $tgl == "0000-00-00" || $tgl == "0001-11-30" || $tgl == "--") {
    return "";
  }

  $nama_hari    =   array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu");
  $nama_bulan   =   array (
                      1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus","September", "Oktober", "November", "Desember"
                    );
  $tahun        =   substr($tgl,0,4);
  $bulan        =   $nama_bulan[(int)substr($tgl,5,2)];
  $tanggal      =   substr($tgl,8,2);

  $text         =   "";

  if ($tampil_hari) {

      $urutan_hari  =   date('w', mktime(0,0,0, substr($tgl,5,2), $tanggal, $tahun));
      $hari         =   $nama_hari[$urutan_hari];
      $text         .=  $hari." ";

  }

  $text         .=$tanggal ." ". $bulan ." ". $tahun;

  if ($with_menit) {

    $jam    =   substr($tgl,11,2);
    $menit  =   substr($tgl,14,2);

    $text   .=  ", ".$jam.":".$menit;
    
  }

  return $text;

}

function format_date($tgl, $format = "Y-m-d")
{

  return date($format, strtotime($tgl));

}

function format_tgl_slash($tgl, $format = "d/m/Y")
{

  return date($format, strtotime($tgl));

}

function format_npwp($string)
{
  $n1=substr($string, 0,2);
  $n2=substr($string, 2,3);
  $n3=substr($string, 6,3);
  $n4=substr($string, 9,1);
  $n5=substr($string, 10,3);
  $n6=substr($string, 13,3);
  $npwp = $n1.'.'.$n2.'.'.$n3.'.'.$n4.'-'.$n5.'.'.$n6;
  return $npwp;

}

function transs( $key, $params = []) {
    $localized = trans($key, $params);
    if ($localized == $key) {
        return "";
    }
    return $localized;
}

function action_h_aksi($id)
{

  $aksi   =   DB::table('h_aksi')->select('aksi')
              ->where('id','=',$id)
              ->first()->aksi;
  $aksi   =   json_decode($aksi,true);

  // echo "<pre>";
  // print_r($aksi);
  // exit();
  $insert_id = 0;

  foreach ($aksi['data_aksi'] as $key => $value) {

    if ($value['aksi'] == "update") {

      if (isset($value['pakai_last_id'])) {

        $new_val  =   json_encode($value);
        $new_val  =   str_replace(':last_inser_id', $insert_id, $new_val);
        $value    =   json_decode($new_val,true);

      }

      DB::table($value['table'])
      // ->where('id', 1)
      ->where($value['where'])
      ->update($value['kolom']);

    }

    if ($value['aksi'] == "delete") {
      // print_r($value['aksi']);

      // DB::table($value['table'])->where('votes', '>', 100)->delete();
      DB::table($value['table'])->where($value['where'])->delete();

    }

    if ($value['aksi'] == "delete_not_in") {
      // print_r($value['aksi']);

      // DB::table($value['table'])->where('votes', '>', 100)->delete();
      DB::table($value['table'])->whereNotIn($value['where']['kolom'],$value['where']['name'])->delete();
      // DB::table('users')
      //               ->whereNotIn('id', [1, 2, 3])
      //               ->get();

    }

    if ($value['aksi'] == "insert") {
      if (isset($value['pakai_last_id'])) {
        $new_val = json_encode($value);
        $new_val = str_replace(':last_inser_id', $insert_id, $new_val);
        $value = json_decode($new_val,true);
      }
      
      DB::table($value['table'])->insert(
                          $value['kolom']
                      );
      if (isset($value['ambil_id'])) {
        $insert_id = DB::getPdo()->lastInsertId(); 
      }
    }
  }
}

function cari_id_menu($grup)
{
  if ($grup == 1) {
      $id_menu = 4;
  } elseif ($grup == 2) {
      $id_menu = 5;
  } elseif ($grup == 3) {
      $id_menu = 6;
  } elseif ($grup == 4) {
      $id_menu = 7;
  }

  return $id_menu;
}

function html_cut($text, $max_length)
{
    return substr(strip_tags($text),0,$max_length);
}

function get_tabel($tabel, $where, $orderBy)
{
  $data = DB::table($tabel)->where($where)
          ->orderBy($orderBy)
          ->get();

  return $data;
}

function time_ago($datetime, $full = false) {
      $now = new DateTime;
      $ago = new DateTime($datetime);
      $diff = $now->diff($ago);

      $diff->w = floor($diff->d / 7);
      $diff->d -= $diff->w * 7;

      $string = array(
          'y' => 'tahun',
          'm' => 'bulan',
          'w' => 'minggu',
          'd' => 'hari',
          'h' => 'jam',
          'i' => 'menit',
          's' => 'detik',
      );
      foreach ($string as $k => &$v) {
          if ($diff->$k) {
              $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
          } else {
              unset($string[$k]);
          }
      }

      if (!$full) $string = array_slice($string, 0, 1);
      return $string ? implode(', ', $string) . ' yang lalu' : 'baru saja';
  }

  function broadcastMessage($kode_template, $models, $route, $item, $show = null, $platform = 1, $param = [], $jenis_notif = 2)
    {
        $m_teks_notif = DB::table("m_teks_notif")->where("kode",'=',$kode_template)->first();
        $judul = $m_teks_notif->judul;
        $judul = str_replace('{pengirim}', session('nama'), $judul);
        $isi = $m_teks_notif->isi;
        $isi = str_replace('{pengirim}', session('nama'), $isi);

        if (is_array($item)) {
          if (isset($item['calon_tenaga_pemasar'])) {
            $isi = str_replace('{calon_tenaga_pemasar}', $item['calon_tenaga_pemasar'], $isi);
          }

          if (isset($item['agen_baru'])) {
            $isi = str_replace('{agen_baru}', $item['agen_baru'], $isi);
          }

          if (isset($item['kode_agen'])) {
            $isi = str_replace('{kode_agen}', $item['kode_agen'], $isi);
          }

          if (isset($item['direct_leader'])) {
            $isi = str_replace('{direct_leader}', $item['direct_leader'], $isi);
          }

          if (isset($item['kantor_pemasaran'])) {
            $isi = str_replace('{kantor_pemasaran}', $item['kantor_pemasaran'], $isi);
          }

          if (isset($item['jenis_pos'])) {
            $judul = str_replace('{jenis_pos}', $item['jenis_pos'], $judul);
            $isi = str_replace('{jenis_pos}', $item['jenis_pos'], $isi);
          }

          if (isset($item['item'])) {
            $judul = str_replace('{item}', $item['item'], $judul);
            $isi = str_replace('{item}', $item['item'], $isi);
          }

          if (isset($item['status'])) {
            $judul = str_replace('{status}', $item['status'], $judul);
            $isi = str_replace('{status}', $item['status'], $isi);
          }


        } else {
          $judul = str_replace('{item}', $item, $judul);
          $isi = str_replace('{item}', $item, $isi);
        }
        

        if ($show == true) {
          $isi = str_replace('{status}', 'Ditampilkan', $isi);
        } else {
          $isi = str_replace('{status}', 'Disembunyikan', $isi);
        }

        if (isset($models['user'][0]['id_username'])) {
          
          $data_notif = [];
          $data_email = [];
          foreach ($models['user'] as $key => $value) {
            $data_notif[] = [
              "id_username" => $value['id_username'],
              "url" => $route,
              "judul" => $judul,
              "isi" => $isi,
              "created_by" => Auth::user()->id_username,
              "readed" => 0,
              "platform" => $platform,
              "param" => json_encode($param),
              "jenis_notif" => $jenis_notif,
            ];

            if ($value['email'] != null && $value['email'] != "") {
              $data_email[] = $value['email'];
            }
            

             DB::table('username')->where('id_username','=',$value['id_username'])->update([
              'new_notif' => DB::raw('new_notif+1'),
            ]);
          }

          if ($platform == 1) {
            DB::table('notif')->insert($data_notif);

            // if (!empty($data_email)) {
            //   send_email($isi,$judul,$data_email);
            // }
            

          } elseif ($platform == 2) {
            DB::table('notif_agen')->insert($data_notif);
          }
          
          try {
            $optionBuilder = new OptionsBuilder();
            $optionBuilder->setTimeToLive(60*20)
                            ->setPriority('high');

            $notificationBuilder = new PayloadNotificationBuilder($judul);
            $notificationBuilder->setBody($isi)
                                ->setSound('default')
                                // ->setBadge('')
                                ->setClickAction($route);

            $dataBuilder = new PayloadDataBuilder();
            $dataBuilder->addData([
                'sender' => session('nama'),
                'title' => $judul,
                'message' => $isi,
                'sender_id' => Auth::user()->id_username,
                "jenis_notif" => $jenis_notif,
                ]);

            $option = $optionBuilder->build();

            $data = $dataBuilder->build();

            if ($platform == 1) {
              $notification = $notificationBuilder->build();

              $token = $models['token_fcm'];

              if (!empty($token)) {
                $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);  
              }
            } elseif ($platform == 2) {
              

              $token = $models['token_fcm']['android'];

              if (!empty($token)) {
                $notification = null;
                $downstreamResponse1 = FCM::sendTo($token, $option, $notification, $data);  
              }

              $token = $models['token_fcm']['ios'];

              if (!empty($token)) {
                $notification = $notificationBuilder->build();
                $downstreamResponse2 = FCM::sendTo($token, $option, $notification, $data);  
              }
              
            }
            
            

            
          } catch (Exception $e) {
            
          }

          
          
          
        }

       
    }


    function send_email($isi, $judul, $data_email)
    {
      $text_html = '
          <html xmlns="http://www.w3.org/1999/xhtml">
          <head>
          <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
          <title>Template Email</title>
          <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
          </head>
          <body style="margin: 0; padding: 0;">
              <table border="0" cellpadding="0" cellspacing="0" width="100%"> 
                  <tr>
                      <td style="padding: 10px 0 30px 0;">
                          <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border: 1px solid #cccccc; border-collapse: collapse;">
                              <tr>

                                  <td align="center" bgcolor="#70bbd9" style="padding: 40px 0 30px 0; color: #153643; font-size: 28px; font-weight: bold; font-family: Arial, sans-serif;">

                                      <span style="color: #ffff">Indosurya Catapult<span>

                                  </td>

                              </tr>

                              <tr>

                                  <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">

                                      '.$isi.'

                                  </td>

                              </tr>

                              <tr>

                                  <td bgcolor="#ee4c50" style="padding: 30px 30px 30px 30px;">

                                      <table border="0" cellpadding="0" cellspacing="0" width="100%">

                                          <tr>

                                              <td style="color: #ffffff; font-family: Arial, sans-serif; font-size: 14px;" width="100%">

                                                  &reg; Indosurya, 2020

                                              </td>

                                          </tr>

                                      </table>

                                  </td>

                              </tr>

                          </table>

                      </td>

                  </tr>

              </table>

          </body>

          </html>

        ';

        $data_email_insert = [
          "email_to" => implode(",", $data_email),
          "subjek" => $judul,
          "isi" => $text_html,
          "created_by" => Auth::user()->id_username,
          "is_send" => 0,
        ];

        SendEmail::dispatch($data_email_insert);

        // DB::table('h_send_email')->insert($data_email_insert);
    }


    function log_user($aksi=0,$data=[])
    {
      LogUser::create([
            'id_ref_aksi' => $aksi,
            'data' => json_encode($data),
            'created_date' => date('Y-m-d H:i:s'),
            'created_by' => Auth::user()->id_username,
        ]);
    }

    function customCrypt($vWord){
        $customKey = "2q9M0LGPRvpLyjn1M8MmJ6lpkxvrLkUw"; 
        $newEncrypter = new \Illuminate\Encryption\Encrypter( $customKey, Config::get( 'app.cipher' ) );
        return $newEncrypter->encrypt( $vWord );
    }

    function customDecrypt($vWord){
      $customKey = "2q9M0LGPRvpLyjn1M8MmJ6lpkxvrLkUw";
      $newEncrypter = new \Illuminate\Encryption\Encrypter( $customKey, Config::get( 'app.cipher' ) );
      return $newEncrypter->decrypt( $vWord );
    }

    if (! function_exists('rupiah')) {
        function rupiah($angka,$mu = true){

          if ($angka == "") {
            $angka = 0;
          } else {
            $angka = floatval($angka);
          }
          $text_mu = "";
          if ($mu) {
            $text_mu = "Rp ";
          }
          $hasil_rupiah = $text_mu . number_format($angka,2,',','.');
          return $hasil_rupiah;
       
      }
    }

    if (! function_exists('ribuan')) {
          function ribuan($angka,$comma = 0){

        $hasil_rupiah = number_format($angka,$comma,',','.');
        return $hasil_rupiah;
       
      }
    }

    if (! function_exists('format_tgl')) {
        function format_tgl($tgl,$format = "d-m-Y", $indo = true){

        if ($indo) {
          $dte = date("Y-m-d",strtotime($tgl));

          return tgl_indo($dte);
        }
        $hasil_rupiah = date($format,strtotime($tgl));
        return $hasil_rupiah;
       
      }
    }

    if (! function_exists('tgl_indo')) {
      function tgl_indo($tanggal){
        $bulan = array (
          1 =>   'Januari',
          'Februari',
          'Maret',
          'April',
          'Mei',
          'Juni',
          'Juli',
          'Agustus',
          'September',
          'Oktober',
          'November',
          'Desember'
        );
        $pecahkan = explode('-', $tanggal);
        
        // variabel pecahkan 0 = tanggal
        // variabel pecahkan 1 = bulan
        // variabel pecahkan 2 = tahun
       
        return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
      }

    }

    if (! function_exists('hitung_umur_bulan')) {
      function hitung_umur_bulan($tanggal_lahir){
        $birthDate = new DateTime($tanggal_lahir);
        $today = new DateTime("today");
        if ($birthDate > $today) { 
            return "0";
        }
        $y = $today->diff($birthDate)->y;
        $m = $today->diff($birthDate)->m;
        $d = $today->diff($birthDate)->d;
        return $m;
      }
    }

    if (! function_exists('hitung_umur_tahun')) {
      function hitung_umur_tahun($tanggal_lahir){
        $birthDate = new DateTime($tanggal_lahir);
        $today = new DateTime("today");
        if ($birthDate > $today) { 
            return "0";
        }
        $y = $today->diff($birthDate)->y;
        $m = $today->diff($birthDate)->m;
        $d = $today->diff($birthDate)->d;

        $year = $y;

        if ($m >= 6) {
          $year = $y + 1;
          if ($m == 6 && $d == 0) {
            $year = $y;
          }
        }

        return $year;
      }
    }

    if (! function_exists('getFormatedNPWP')) {
      function getFormatedNPWP($npwp) {
        $ret = substr($npwp,0,2)."."
        .substr($npwp,2,3)."."
        .substr($npwp,5,3)."."
        .substr($npwp,8,1)."-"
        .substr($npwp,9,3)."."
        .substr($npwp,12,3);
        return $ret;
      }
    }

    if (! function_exists('stripFormatedNPWP')) {
      function stripFormatedNPWP($npwp) {
        $strStrip = array("-", ".");
        if (!is_array($npwp)) {
          $ret = trim(str_replace($strStrip, "", $npwp));
        } else {
          for ($i=0; $i<sizeof($npwp); $i++) {
            $npwp[$i] = trim(str_replace($strStrip, "", $npwp[$i]));
          }
          $ret = $npwp;
        }

        return $ret;
      }
    }

    if (! function_exists('generateSaltMd5')) {
      function generateSaltMd5($password) {
        $salt = "+!57";
        $password = substr_replace($password,$salt,2,0);
        $password = md5($password);

        return $password;
      } 
    }

    if (! function_exists('generateRandomString')) {
      function generateRandomString($length = 10) {
          $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
          $charactersLength = strlen($characters);
          $randomString = '';
          for ($i = 0; $i < $length; $i++) {
              $randomString .= $characters[rand(0, $charactersLength - 1)];
          }
          return $randomString;
      }
    }

    if (! function_exists('formulirSoalLanjutan')) {
      function formulirSoalLanjutan($id_soal,$id_spaj_kuesioner) {
          $value = DB::table("ref_kuesioner_soal as a")
                    ->where("a.id_ref_bahasa",$id_soal)
                    ->where("a.id_bahasa",DB::raw("'".session('id_locale')."'"))
                    ->first();

          // return $value;

          $titik = "";
          $style_css = "";
          $class_ml = "ml-4";

          if ($value->no != "") {
            $titik = ".";
            $style_css = 'style="margin-left: -1.5rem;"';
            $class_ml = "";
          }

          $text_jawaban = '<div class="text-grey text-bold" '.$style_css.'><label>'.$value->no.$titik.' &nbsp;'.$value->soal.'</label></div>';

          if ($value->tipe_soal == 1) {
            $jawaban = DB::table("t_spaj_kuesioner_jawaban as a")->select("a.uraian")
                      ->where("a.id_spaj_kuesioner",$id_spaj_kuesioner)
                      ->where("a.id_kuesioner_soal",$value->id_kuesioner_soal)
                      ->where("a.deleted",1)->first();
            $t_jwb = "";
            if ($jawaban) {
              $t_jwb = $jawaban->uraian;
            }
            $text_jawaban .= "<label class='".$class_ml."'>-&nbsp;</label>"."<label>".$t_jwb."</label>";

          } elseif ($value->tipe_soal == 2) {
            $jawaban = DB::table("t_spaj_kuesioner_jawaban as a")
                  ->select("a.uraian","b.*")
                  ->leftJoin("ref_kuesioner_jawaban as b", function($join)
                            {
                                 $join->on('a.id_kuesioner_jawaban', '=', 'b.id_kuesioner_jawaban');
                                 $join->on('b.deleted','=', DB::raw(1));
                            })
                  ->where("a.id_kuesioner_soal",$value->id_kuesioner_soal)
                  ->where("a.id_spaj_kuesioner",$id_spaj_kuesioner)
                  ->orderBy("b.urutan","asc")
                  ->where("a.deleted",1)->first();

            $text_jawaban1 = '<div class="'.$class_ml.'">
                <label>-&nbsp;</label><label>'.$jawaban->jawaban.'</label>
              </div>';

            if ($jawaban->wajib_dijelaskan == 1) {
              $text_jawaban1 .= '<div class="text-grey text-bold '.$class_ml.'"><label>'.$jawaban->hint_dijelaskan.'</label></div>
                            <div class="'.$class_ml.'">
                            <label>-&nbsp;</label><label>'.$jawaban->uraian.'</label>
                          </div>';
            }

            $text_jawaban .= $text_jawaban1;


          } elseif ($value->tipe_soal == 3) {

            $jawaban = DB::table("t_spaj_kuesioner_jawaban as a")
                  ->select("a.uraian","b.*")
                  ->leftJoin("ref_kuesioner_jawaban as b", function($join)
                            {
                                 $join->on('a.id_kuesioner_jawaban', '=', 'b.id_kuesioner_jawaban');
                                 $join->on('b.deleted','=', DB::raw(1));
                            })
                  ->where("a.id_kuesioner_soal",$value->id_kuesioner_soal)
                  ->where("a.id_spaj_kuesioner",$id_spaj_kuesioner)
                  ->orderBy("b.urutan","asc")
                  ->where("a.deleted",1)->get();

            foreach ($jawaban as $k => $v) {
              $text_jawaban1 = '<div class="mt-3 '.$class_ml.'">
                <label>-&nbsp;</label><label>'.$v->jawaban.'</label>
              </div>';

              if ($v->wajib_dijelaskan == 1) {
                $text_jawaban1 .= '<div class=" '.$class_ml.'"><label>'.$v->hint_dijelaskan.'</label></div>
                            <div class="'.$class_ml.'">
                            <label><i>'.$v->uraian.'</i></label>
                          </div>';
              }

              // if ($v->id_soal_lanjutan != 0) {
              //  $text_jawaban1 .= '<div class="text-grey text-bold"><label>'.$v->hint_dijelaskan.'</label></div>
                //            <div>
                //            <label>-&nbsp;</label><label>'.$v->uraian.'</label>
                //          </div>';
              // }

              $text_jawaban .= $text_jawaban1;
            }

          } elseif ($value->tipe_soal == 4) {
            $jawaban = DB::table("t_spaj_kuesioner_jawaban as a")
                  ->select("a.uraian","b.multidata")
                  ->leftJoin("ref_kuesioner_soal as b", function($join)
                            {
                                 $join->on('a.id_kuesioner_soal', '=', 'b.id_kuesioner_soal');
                                 $join->on('b.deleted','=', DB::raw(1));
                            })
                            ->where("a.id_spaj_kuesioner",$id_spaj_kuesioner)
                            ->where("a.id_kuesioner_soal",$value->id_kuesioner_soal)
                            ->where("a.deleted",1)->first();

                
            $multidata = json_decode($jawaban->multidata);
            $multidata = $multidata->kolom;

            $uraian = json_decode($jawaban->uraian);

                // print_r($multidata);
            $td_head = "";
            $td_body = "";

            foreach ($multidata as $k => $v) {
              $td_head .= '<th class="text-center">'.$v->label.'</th>';
              $field = $v->field;
            }

            foreach ($uraian as $ky => $ve) {
              $text_fild = "";
              foreach ($multidata as $k => $v) {
                $field = $v->field;
                $tipe = $v->tipe;

                $txt = "";
                if ($tipe == "date") {
                  $txt = $ve->$field;
                  
                  if(strtotime($ve->$field)){
                    $txt = format_tanggal($ve->$field,false,false);
                  }
                  
                } else if ($tipe == "text") {
                  $txt = $ve->$field;
                } else {
                  $txt = $ve->$field;
                }

                $text_fild .= '<td class="text-center">'.$txt.'</td>';

              }
              $td_body .= '<tr>'.$text_fild.'</tr>';
            }


            $text_jawaban .= '<div><table class="w-100" cellpadding="5" border="1">
              <thead>
                <tr>
                  '.$td_head.'
                </tr>
              </thead>
              <tbody>
                '.$td_body.'
              </tbody>
            </table></div>';
          } elseif ($value->tipe_soal == 5) {
            $jawaban = DB::table("t_spaj_kuesioner_jawaban as a")->select("a.uraian")
                      ->where("a.id_spaj_kuesioner",$id_spaj_kuesioner)
                      ->where("a.id_kuesioner_soal",$value->id_kuesioner_soal)
                      ->where("a.deleted",1)->first();

            $txt = $jawaban->uraian;
            if(strtotime($jawaban->uraian)){
                $txt = format_tanggal($jawaban->uraian,false,false);
            }

            $text_jawaban .= "<label class='".$class_ml."'>-&nbsp;</label>"."<label>".$txt."</label>";

          } elseif ($value->tipe_soal == 6) {
            $jawaban = DB::table("t_spaj_kuesioner_jawaban as a")->select("a.uraian")
                  ->where("a.id_spaj_kuesioner",$id_spaj_kuesioner)
                  ->where("a.id_kuesioner_soal",$value->id_kuesioner_soal)
                  ->where("a.deleted",1)->first();
            $txt = $jawaban->uraian;
            $id_tambang = explode("-", $txt);

            $jenis_tambang_text = "";
            if (isset($id_tambang[0])) {
              $jenis_tambang = DB::table("ref_jenis_pertambangan as a")->select("a.nama_jenis_pertambangan")
                  ->where("a.id_jenis_pertambangan",$id_tambang[0])->first();

              if ($jenis_tambang) {
                $jenis_tambang_text = $jenis_tambang->nama_jenis_pertambangan;
              }
              
            }

            $nama_tambang_text = "";
            if (isset($id_tambang[1])) {
              $nama_tambang = DB::table("m_pertambangan as a")->select("a.nama_pekerjaan")
                  ->where("a.id_pertambangan",$id_tambang[1])->first();

              if ($nama_tambang) {
                $nama_tambang_text = $nama_tambang->nama_pekerjaan;
              }
              
            }
            $text_jawaban .= "<label>-&nbsp;</label>"."<label>".$jenis_tambang_text." - ".$nama_tambang_text."</label>";
          }

          return $text_jawaban;
      }

      
    }

    if (! function_exists('formulirSoalLanjutanInboxList')) {
      function formulirSoalLanjutanInboxList($id_soal,$id_spaj_kuesioner) {
          $value = DB::table("ref_kuesioner_soal as a")
                    ->where("a.id_ref_bahasa",$id_soal)
                    ->where("a.id_bahasa",DB::raw("'".session('id_locale')."'"))
                    ->first();

          // return $value;
          $arr_t_spaj_kuesioner_jawaban_id = [];

          $text_jawaban = '<label class="col-12 text-grey text-bold mt-2" >'.$value->no.'. &nbsp;'.$value->soal.'</label>';

          if ($value->tipe_soal == 1) {
            $jawaban = DB::table("t_spaj_kuesioner_jawaban as a")->select("a.id","a.uraian")
                  ->where("a.id_spaj_kuesioner",$id_spaj_kuesioner)
                  ->where("a.id_kuesioner_soal",$value->id_kuesioner_soal)
                  ->where("a.deleted",1)->first();

            if ($jawaban) {
              $arr_t_spaj_kuesioner_jawaban_id[] = $jawaban->id;

              $text_jawaban .= '<div class="col-12">
                <textarea class="form-control" rows="5" disabled>'.$jawaban->uraian.'</textarea>
              </div>';
            } else {
              $arr_t_spaj_kuesioner_jawaban_id[] = 0;

              $text_jawaban .= '<div class="col-12">
                <textarea class="form-control" rows="5" disabled></textarea>
              </div>';
            }
            

          } elseif ($value->tipe_soal == 2) {
            $jawaban_db = DB::table("ref_kuesioner_jawaban as a")
                ->where("a.deleted",1)
                ->where("a.id_kuesioner_soal",$value->id_kuesioner_soal)
                ->orderBy("a.urutan","asc")
                ->get();

            $jawaban = DB::table("t_spaj_kuesioner_jawaban as a")
                  ->select("a.*")
                  ->where("a.id_kuesioner_soal",$value->id_kuesioner_soal)
                  ->where("a.id_spaj_kuesioner",$id_spaj_kuesioner)
                  ->where("a.deleted",1)->first();

            $text_jawaban1 = "";
            $text_wajib_dijelaskan = "";
            $soal_lanjutan_text = "";
            foreach ($jawaban_db as $k => $v) {
              $check = "";
              if ($v->id_kuesioner_jawaban == $jawaban->id_kuesioner_jawaban) {
                $check = "checked";
                $arr_t_spaj_kuesioner_jawaban_id[] = $jawaban->id;

                if ($v->wajib_dijelaskan == 1) {
                  $text_wajib_dijelaskan = '<div class="col-12">
                          <div class="form-group row">
                                <label for="no_npwp_pempol" class="col-sm-2 col-form-label text-grey text-bold">'.$v->hint_dijelaskan.'</label>
                                <div class="col-sm-10">
                                  <textarea class="form-control" rows="5" disabled>'.$jawaban->uraian.'</textarea>
                                </div>
                              </div>
                          </div>';
                }

              }

              $text_jawaban1 .= '<div class="col-3">
                             <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" disabled value="'.$v->id_kuesioner_jawaban.'" '.$check.'>
                                '.$v->jawaban.'
                              <i class="input-helper"></i></label>
                            </div>
                          </div>';
            }

            $text_jawaban1 .= $text_wajib_dijelaskan;

            
            $text_jawaban1 .= $soal_lanjutan_text;
              // print_r(formulirSoalLanjutan($jawaban->id_soal_lanjutan));
              

            $text_jawaban .= $text_jawaban1;


          } elseif ($value->tipe_soal == 3) {

            // $text_jawaban = "";
            $jawaban_db = DB::table("ref_kuesioner_jawaban as a")
                  ->where("a.deleted",1)
                  ->where("a.id_kuesioner_soal",$value->id_kuesioner_soal)
                  ->orderBy("a.urutan","asc")
                  ->get();

            $jawaban = DB::table("t_spaj_kuesioner_jawaban as a")
                  ->select("a.*")
                  ->where("a.id_kuesioner_soal",$value->id_kuesioner_soal)
                  ->where("a.id_spaj_kuesioner",$id_spaj_kuesioner)
                  ->where("a.deleted",1)->get();

            $jawaban_user_id = $jawaban->pluck('id_kuesioner_jawaban')->toArray();
            $uraian_user_id = $jawaban->pluck('uraian','id_kuesioner_jawaban')->toArray();
            $id_jawaban_user_id = $jawaban->pluck('id','id_kuesioner_jawaban')->toArray();

            foreach ($jawaban_db as $k => $v) {
              $check = "";
              $uraian_user = "";
              if (in_array($v->id_kuesioner_jawaban, $jawaban_user_id)) {
                $check = "checked";
                $uraian_user = $uraian_user_id[$v->id_kuesioner_jawaban];
                $arr_t_spaj_kuesioner_jawaban_id[] = $id_jawaban_user_id[$v->id_kuesioner_jawaban];
              }

              $text_jawaban1 = '<div class="col-2">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" value="'.$v->id_kuesioner_jawaban.'" '.$check.' disabled>
                                '.$v->jawaban.'
                              <i class="input-helper"></i></label>
                            </div>
                          </div>';

              if ($v->wajib_dijelaskan == 1) {
                $text_jawaban1 .= '<div class="col-12">
                          <div class="form-group row">
                                <label for="no_npwp_pempol" class="col-sm-2 col-form-label text-grey text-bold">'.$v->hint_dijelaskan.'</label>
                                <div class="col-sm-10">
                                  <textarea class="form-control" rows="5" disabled>'.$uraian_user.'</textarea>
                                </div>
                              </div>
                          </div>';
              }

              $text_jawaban .= $text_jawaban1;
            }

          } elseif ($value->tipe_soal == 4) {
            $jawaban = DB::table("t_spaj_kuesioner_jawaban as a")
                  ->select("a.id","a.uraian","b.multidata")
                  ->leftJoin("ref_kuesioner_soal as b", function($join)
                            {
                                 $join->on('a.id_kuesioner_soal', '=', 'b.id_kuesioner_soal');
                                 $join->on('b.deleted','=', DB::raw(1));
                            })
                            ->where("a.id_kuesioner_soal",$value->id_kuesioner_soal)
                            ->where("a.id_spaj_kuesioner",$id_spaj_kuesioner)
                            ->where("a.deleted",1)->first();

            $arr_t_spaj_kuesioner_jawaban_id[] = $jawaban->id;

            $multidata = json_decode($jawaban->multidata);
            $multidata = $multidata->kolom;

            $uraian = json_decode($jawaban->uraian);

                // print_r($multidata);
            $td_head = "";
            $td_body = "";

            foreach ($multidata as $k => $v) {
              $td_head .= '<th class="text-center">'.$v->label.'</th>';
              $field = $v->field;
            }

            foreach ($uraian as $ky => $ve) {
              // $text_fild = "<td>Ini opsi</td>";
              $text_fild = "";
              foreach ($multidata as $k => $v) {
                $field = $v->field;
                $tipe = $v->tipe;

                $txt = "";
                if ($tipe == "date") {
                  $txt = $ve->$field;
                  
                  if(strtotime($ve->$field)){
                    $txt = format_tanggal($ve->$field,false,false);
                  }
                  
                } else if ($tipe == "text") {
                  $txt = $ve->$field;
                } else {
                  $txt = $ve->$field;
                }

                $text_fild .= '<td class="text-center">'.$txt.'</td>';
              }
              $td_body .= '<tr>'.$text_fild.'</tr>';
            }


            $text_jawaban .= '<div class="col-12"><table class="table table-bordered">
              <thead>
                <tr>
                  '.$td_head.'
                </tr>
              </thead>
              <tbody>
                '.$td_body.'
              </tbody>
            </table></div>';
          } elseif ($value->tipe_soal == 5) {

            $jawaban = DB::table("t_spaj_kuesioner_jawaban as a")->select("a.id","a.uraian")
                  ->where("a.id_spaj_kuesioner",$id_spaj_kuesioner)
                  ->where("a.id_kuesioner_soal",$value->id_kuesioner_soal)
                  ->where("a.deleted",1)->first();

            $arr_t_spaj_kuesioner_jawaban_id[] = $jawaban->id;

            $txt = $jawaban->uraian;
            if(strtotime($jawaban->uraian)){
                $txt = format_tanggal($jawaban->uraian,false,false);
            }

            $text_jawaban .= '<div class="col-12">
              <textarea class="form-control" rows="5" disabled>'.$txt.'</textarea>
            </div>';

          } elseif ($value->tipe_soal == 6) {
            $jawaban = DB::table("t_spaj_kuesioner_jawaban as a")->select("a.id","a.uraian")
                  ->where("a.id_spaj_kuesioner",$id_spaj_kuesioner)
                  ->where("a.id_kuesioner_soal",$value->id_kuesioner_soal)
                  ->where("a.deleted",1)->first();

            $arr_t_spaj_kuesioner_jawaban_id[] = $jawaban->id;

            $txt = $jawaban->uraian;
            $id_tambang = explode("-", $txt);

            $jenis_tambang_text = "";
            if (isset($id_tambang[0])) {
              $jenis_tambang = DB::table("ref_jenis_pertambangan as a")->select("a.nama_jenis_pertambangan")
                  ->where("a.id_jenis_pertambangan",$id_tambang[0])->first();

              if ($jenis_tambang) {
                $jenis_tambang_text = $jenis_tambang->nama_jenis_pertambangan;
              }
              
            }

            $nama_tambang_text = "";
            if (isset($id_tambang[1])) {
              $nama_tambang = DB::table("m_pertambangan as a")->select("a.nama_pekerjaan")
                  ->where("a.id_pertambangan",$id_tambang[1])->first();

              if ($nama_tambang) {
                $nama_tambang_text = $nama_tambang->nama_pekerjaan;
              }
              
            }
            $text_jawaban .= '<div class="col-12">
                <textarea class="form-control" rows="5" disabled>'.$jenis_tambang_text.' - '.$nama_tambang_text.'</textarea>
              </div>';
          }

          return [
                    "text" => $text_jawaban,
                    "id_jawaban" => $arr_t_spaj_kuesioner_jawaban_id,
                  ];
      }

      
    }

    if (! function_exists('formulirSoalLanjutanUwWorklist')) {
      function formulirSoalLanjutanUwWorklist($id_soal,$id_spaj_kuesioner) {
          $value = DB::table("ref_kuesioner_soal as a")
                    ->where("a.id_ref_bahasa",$id_soal)
                    ->where("a.id_bahasa",DB::raw("'".session('id_locale')."'"))
                    ->first();


          $titik = "";
          $style_css = "";
          $class_ml = "ml-4";

          if ($value->no != "") {
            $titik = ".";
            $style_css = 'style="margin-left: -1.5rem;"';
            $class_ml = "";
          }

          // return $value;
          $arr_t_spaj_kuesioner_jawaban_id = [];

          $arr_t_spaj_soal = [
            "id_spaj_kuesioner" => $id_spaj_kuesioner,
            "id_kuesioner_soal" => $value->id_kuesioner_soal,
            "tipe_soal" => $value->tipe_soal,
            "jawaban" => [],
          ];

          $text_jawaban = '<label class="col-12 text-grey text-bold mt-2" '.$style_css.' >'.$value->no.'. &nbsp;'.$value->soal.'</label>';

          if ($value->tipe_soal == 1) {
            $jawaban = DB::table("t_spaj_kuesioner_jawaban as a")->select("a.id","a.uraian","a.id_kuesioner_jawaban")
                  ->where("a.id_spaj_kuesioner",$id_spaj_kuesioner)
                  ->where("a.id_kuesioner_soal",$value->id_kuesioner_soal)
                  ->where("a.deleted",1)->first();

            if ($jawaban) {
              $arr_t_spaj_kuesioner_jawaban_id[] = $jawaban->id;

              $arr_t_spaj_soal["jawaban"][] = [
                'id_kuesioner_jawaban' => strval($jawaban->id_kuesioner_jawaban),
                'uraian' => strval($jawaban->uraian),
              ];

              $text_jawaban .= '<div class="col-12">
                <textarea class="form-control jawabanTSpajKuesionerJawabanTipe1_'.$id_spaj_kuesioner.'_'.$value->id_kuesioner_soal.'" rows="5">'.$jawaban->uraian.'</textarea>
              </div>';
            } else {
              $arr_t_spaj_kuesioner_jawaban_id[] = 0;

              $arr_t_spaj_soal["jawaban"][] = [
                'id_kuesioner_jawaban' => "0",
                'uraian' => "",
              ];

              $text_jawaban .= '<div class="col-12">
                <textarea class="form-control jawabanTSpajKuesionerJawabanTipe1_'.$id_spaj_kuesioner.'_'.$value->id_kuesioner_soal.'" rows="5"></textarea>
              </div>';
            }
            

          } elseif ($value->tipe_soal == 2) {
            $jawaban_db = DB::table("ref_kuesioner_jawaban as a")
                ->where("a.deleted",1)
                ->where("a.id_kuesioner_soal",$value->id_kuesioner_soal)
                ->orderBy("a.urutan","asc")
                ->get();

            $jawaban = DB::table("t_spaj_kuesioner_jawaban as a")
                  ->select("a.*")
                  ->where("a.id_kuesioner_soal",$value->id_kuesioner_soal)
                  ->where("a.id_spaj_kuesioner",$id_spaj_kuesioner)
                  ->where("a.deleted",1)->first();

        
            $text_jawaban1 = "";
            $text_wajib_dijelaskan = "";
            $soal_lanjutan_text = "";
            foreach ($jawaban_db as $k => $v) {
              $check = "";
              if ($v->id_kuesioner_jawaban == $jawaban->id_kuesioner_jawaban) {
                $check = "checked";
                $arr_t_spaj_kuesioner_jawaban_id[] = $jawaban->id;

                if ($v->wajib_dijelaskan == 1) {
                  $text_wajib_dijelaskan = '<div class="col-12">
                          <div class="form-group row">
                                <label for="no_npwp_pempol" class="col-sm-2 col-form-label text-grey text-bold">'.$v->hint_dijelaskan.'</label>
                                <div class="col-sm-10">
                                  <textarea class="form-control jawabanTSpajKuesionerJawabanTipe2Wdj_'.$id_spaj_kuesioner.'_'.$value->id_kuesioner_soal.'" rows="5">'.$jawaban->uraian.'</textarea>
                                </div>
                              </div>
                          </div>';
                }

                $arr_t_spaj_soal["jawaban"][] = [
                  'id_kuesioner_jawaban' => strval($jawaban->id_kuesioner_jawaban),
                  'uraian' => strval($jawaban->uraian),
                ];

              }

              $text_jawaban1 .= '<div class="col-3">
                             <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input jawabanTSpajKuesionerJawabanTipe2_'.$id_spaj_kuesioner.'_'.$value->id_kuesioner_soal.'" value="'.$v->id_kuesioner_jawaban.'" '.$check.'>
                                '.$v->jawaban.'
                              <i class="input-helper"></i></label>
                            </div>
                          </div>';
            }

            $text_jawaban1 .= $text_wajib_dijelaskan;

            
            $text_jawaban1 .= $soal_lanjutan_text;
              // print_r(formulirSoalLanjutan($jawaban->id_soal_lanjutan));
              

            $text_jawaban .= $text_jawaban1;


          } elseif ($value->tipe_soal == 3) {

            $jawaban_db = DB::table("ref_kuesioner_jawaban as a")
                  ->where("a.deleted",1)
                  ->where("a.id_kuesioner_soal",$value->id_kuesioner_soal)
                  ->orderBy("a.urutan","asc")
                  ->get();

            $jawaban = DB::table("t_spaj_kuesioner_jawaban as a")
                  ->select("a.*")
                  ->where("a.id_kuesioner_soal",$value->id_kuesioner_soal)
                  ->where("a.id_spaj_kuesioner",$id_spaj_kuesioner)
                  ->where("a.deleted",1)->get();

            $jawaban_user_id = $jawaban->pluck('id_kuesioner_jawaban')->toArray();
            $uraian_user_id = $jawaban->pluck('uraian','id_kuesioner_jawaban')->toArray();
            $id_jawaban_user_id = $jawaban->pluck('id','id_kuesioner_jawaban')->toArray();

            foreach ($jawaban_db as $k => $v) {
              $check = "";
              $uraian_user = "";
              if (in_array($v->id_kuesioner_jawaban, $jawaban_user_id)) {
                $check = "checked";
                $uraian_user = $uraian_user_id[$v->id_kuesioner_jawaban];
                $arr_t_spaj_kuesioner_jawaban_id[] = $id_jawaban_user_id[$v->id_kuesioner_jawaban];

                $arr_t_spaj_soal["jawaban"][] = [
                  'id_kuesioner_jawaban' => strval($v->id_kuesioner_jawaban),
                  'uraian' => strval($uraian_user_id[$v->id_kuesioner_jawaban]),
                ];
              }

              $text_jawaban1 = '<div class="col-2">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input jawabanTSpajKuesionerJawabanTipe3_'.$id_spaj_kuesioner.'_'.$value->id_kuesioner_soal.'" value="'.$v->id_kuesioner_jawaban.'" '.$check.'>
                                '.$v->jawaban.'
                              <i class="input-helper"></i></label>
                            </div>
                          </div>';

              if ($v->wajib_dijelaskan == 1) {
                $text_jawaban1 .= '<div class="col-12">
                          <div class="form-group row">
                                <label for="no_npwp_pempol" class="col-sm-2 col-form-label text-grey text-bold">'.$v->hint_dijelaskan.'</label>
                                <div class="col-sm-10">
                                  <textarea class="form-control jawabanTSpajKuesionerJawabanTipe3Wdj_'.$id_spaj_kuesioner.'_'.$value->id_kuesioner_soal.'" rows="5">'.$uraian_user.'</textarea>
                                </div>
                              </div>
                          </div>';
              }

              $text_jawaban .= $text_jawaban1;
            }

          } elseif ($value->tipe_soal == 4) {
            $jawaban = DB::table("t_spaj_kuesioner_jawaban as a")
                  ->select("a.id","a.uraian","b.multidata",'a.id_kuesioner_jawaban')
                  ->leftJoin("ref_kuesioner_soal as b", function($join)
                            {
                                 $join->on('a.id_kuesioner_soal', '=', 'b.id_kuesioner_soal');
                                 $join->on('b.deleted','=', DB::raw(1));
                            })
                            ->where("a.id_spaj_kuesioner",$id_spaj_kuesioner)
                            ->where("a.id_kuesioner_soal",$value->id_kuesioner_soal)
                            ->where("a.deleted",1)->first();

            $arr_t_spaj_kuesioner_jawaban_id[] = $jawaban->id;

            $multidata = json_decode($jawaban->multidata);
            $multidata = $multidata->kolom;

            $uraian = json_decode($jawaban->uraian);

                // print_r($multidata);
            $arr_t_spaj_soal["jawaban"][] = [
                'id_kuesioner_jawaban' => $jawaban->id_kuesioner_jawaban,
                'uraian' => $jawaban->uraian,
              ];

            $td_head = "";
            $td_body = "";
            $c_multidata = count($multidata);

            $tr_hidden = '<tr class="trMultidata d-none">';

            $tr_hidden .= '<td>
                    <span class="mdi mdi-delete deleteKuesionerJawabDinamis" style="font-size: 15pt; color: red; cursor: pointer;" title="Hapus"></span>
                  </td>';

            foreach ($multidata as $k => $v) {
              $td_head .= '<th class="text-center">'.$v->label.'</th>';
              $field = $v->field;

              $tipe = $v->tipe;
              if ($tipe == "date") {

                  $tr_hidden .= '<td class="text-center"><input type="date" class="form-control jawabanTSpajKuesionerJawabanTipe4_'.$id_spaj_kuesioner.'_'.$value->id_kuesioner_soal.'" data-grup="'.$v->field.'" data-jmlh="'.$c_multidata.'" value=""></td>';
                  
              } else if ($tipe == "text") {
                  $tr_hidden .= '<td class="text-center"><input type="text" class="form-control jawabanTSpajKuesionerJawabanTipe4_'.$id_spaj_kuesioner.'_'.$value->id_kuesioner_soal.'" data-grup="'.$v->field.'" data-jmlh="'.$c_multidata.'" value=""></td>';
              } else {
                  $tr_hidden .= '<td class="text-center"><input type="text" class="form-control jawabanTSpajKuesionerJawabanTipe4_'.$id_spaj_kuesioner.'_'.$value->id_kuesioner_soal.'" data-grup="'.$v->field.'" data-jmlh="'.$c_multidata.'" value=""></td>';
              }
            }

            $tr_hidden .= "</tr>";

            $td_body .= $tr_hidden;

            if (count($uraian)) {
              foreach ($uraian as $ky => $ve) {
                $text_fild = '<td>
                  <span class="mdi mdi-delete deleteKuesionerJawabDinamis" style="font-size: 15pt; color: red; cursor: pointer;" title="Hapus"></span>
                </td>';

                foreach ($multidata as $k => $v) {
                  $field = $v->field;
                  

                  $tipe = $v->tipe;

                  $txt = "";
                  if ($tipe == "date") {
                      $txt = $ve->$field;

                      $text_fild .= '<td class="text-center"><input type="date" class="form-control jawabanTSpajKuesionerJawabanTipe4_'.$id_spaj_kuesioner.'_'.$value->id_kuesioner_soal.'" data-grup="'.$v->field.'" data-jmlh="'.$c_multidata.'" value="'.$ve->$field.'"></td>';
                      
                  } else if ($tipe == "text") {
                      $text_fild .= '<td class="text-center"><input type="text" class="form-control jawabanTSpajKuesionerJawabanTipe4_'.$id_spaj_kuesioner.'_'.$value->id_kuesioner_soal.'" data-grup="'.$v->field.'" data-jmlh="'.$c_multidata.'" value="'.$ve->$field.'"></td>';
                  } else {
                      $text_fild .= '<td class="text-center"><input type="text" class="form-control jawabanTSpajKuesionerJawabanTipe4_'.$id_spaj_kuesioner.'_'.$value->id_kuesioner_soal.'" data-grup="'.$v->field.'" data-jmlh="'.$c_multidata.'" value="'.$ve->$field.'"></td>';
                  }

                }
                $td_body .= '<tr class="trMultidata">'.$text_fild.'</tr>';
              }
            }
            

            $text_jawaban .= '<div class="col-12"><table class="table table-bordered">
              <thead>
                <tr>
                  <th>Opsi</th>
                  '.$td_head.'
                </tr>
              </thead>
              <tbody class="tableBodyMultidata">
                '.$td_body.'
              </tbody>
            </table>
            <a href="javascript:undefined" class="mt-3 addMultidata" >Tambah</a> 
            </div>';

          } elseif ($value->tipe_soal == 5) {

            $jawaban = DB::table("t_spaj_kuesioner_jawaban as a")->select("a.id","a.uraian","a.id_kuesioner_jawaban")
                  ->where("a.id_spaj_kuesioner",$id_spaj_kuesioner)
                  ->where("a.id_kuesioner_soal",$value->id_kuesioner_soal)
                  ->where("a.deleted",1)->first();

            $arr_t_spaj_kuesioner_jawaban_id[] = $jawaban->id;

            $arr_t_spaj_soal["jawaban"][] = [
              'id_kuesioner_jawaban' => strval($jawaban->id_kuesioner_jawaban),
              'uraian' => strval($jawaban->uraian),
            ];

            $text_jawaban .= '<div class="col-12">
                <input type="date" class="form-control jawabanTSpajKuesionerJawabanTipe5_'.$id_spaj_kuesioner.'_'.$value->id_kuesioner_soal.'" value="'.$jawaban->uraian.'">
            </div>';
         
                
          } elseif ($value->tipe_soal == 6) {

           
                $jawaban = DB::table("t_spaj_kuesioner_jawaban as a")->select("a.*")
                            ->where("a.id_spaj_kuesioner",$id_spaj_kuesioner)
                            ->where("a.id_kuesioner_soal",$value->id_kuesioner_soal)
                            ->where("a.deleted",1)->first();
                            
                $arr_t_spaj_kuesioner_jawaban_id[] = $jawaban->id;

                $arr_t_spaj_soal["jawaban"][] = [
                  'id_kuesioner_jawaban' => strval($jawaban->id_kuesioner_jawaban),
                  'uraian' => strval($jawaban->uraian),
                ];

                $txt = $jawaban->uraian;
                $id_tambang = explode("-", $txt);

                $jenis_tambang_text = "";
                $jenis_tambang_id = "1";
                if (isset($id_tambang[0])) {
                    $jenis_tambang_id = $id_tambang[0];
                    $jenis_tambang = DB::table("ref_jenis_pertambangan as a")->select("a.nama_jenis_pertambangan")
                            ->where("a.id_jenis_pertambangan",$id_tambang[0])->first();

                    if ($jenis_tambang) {
                        $jenis_tambang_text = $jenis_tambang->nama_jenis_pertambangan;
                    }
                    
                }

                $nama_tambang_text = "";
                $nama_tambang_id = "";
                if (isset($id_tambang[1])) {
                    $nama_tambang_id = $id_tambang[1];
                    $nama_tambang = DB::table("m_pertambangan as a")->select("a.nama_pekerjaan")
                            ->where("a.id_pertambangan",$id_tambang[1])->first();

                    if ($nama_tambang) {
                        $nama_tambang_text = $nama_tambang->nama_pekerjaan;
                    }
                    
                }

                $get_jenis_tambang = DB::table("ref_jenis_pertambangan as a")->select("a.id_jenis_pertambangan","a.nama_jenis_pertambangan")->get();

                $opt_jenis_tambang = "";

                foreach ($get_jenis_tambang as $ky => $vy) {
                    $selected = $vy->id_jenis_pertambangan == $jenis_tambang_id ? 'selected' : '';
                    $opt_jenis_tambang .= '<option value="'.$vy->id_jenis_pertambangan.'" '.$selected.'>'.$vy->nama_jenis_pertambangan.'</option>';
                }

                $get_nama_tambang = DB::table("m_pertambangan as a")->select("a.id_pertambangan","a.nama_pekerjaan")->where("id_bahasa",1)->where("deleted",1)->where("id_jenis_pertambangan",$jenis_tambang_id)->get();

                $opt_nama_tambang = "";

                foreach ($get_nama_tambang as $ky => $vy) {
                    $selected = $vy->id_pertambangan == $nama_tambang_id ? 'selected' : '';
                    $opt_nama_tambang .= '<option value="'.$vy->id_pertambangan.'" '.$selected.'>'.$vy->nama_pekerjaan.'</option>';
                }

                $text_jawaban .= '<div class="col-6">
                    <select class="form-control selectJenisTambang mySelect2 jawabanTSpajKuesionerJawabanTipe6_'.$id_spaj_kuesioner.'_'.$value->id_kuesioner_soal.'_1" data-id="'.$id_spaj_kuesioner.'_'.$value->id_kuesioner_soal.'">'.$opt_jenis_tambang.'</select>
                </div>
                <div class="col-6">
                    <select class="form-control mySelect2 jawabanTSpajKuesionerJawabanTipe6_'.$id_spaj_kuesioner.'_'.$value->id_kuesioner_soal.'_2">'.$opt_nama_tambang.'</select>
                </div>';
                
                
            }

          return [
                    "text" => $text_jawaban,
                    "id_jawaban" => $arr_t_spaj_kuesioner_jawaban_id,
                    "json_old_jawaban" => $arr_t_spaj_soal,
                  ];
      }

      
    }

    if (! function_exists('formulirSoalLanjutanPdf')) {
      function formulirSoalLanjutanPdf($id_soal,$id_spaj_kuesioner) {
          $v = DB::table("ref_kuesioner_soal as a")
                    ->where("a.id_ref_bahasa",$id_soal)
                    ->where("a.id_bahasa",1)
                    ->first();

          $arr_abjad = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];

          // return $value;

          $titik = "";
          $style_css = "";
          $class_ml = "ml-4";

          if ($v->no != "") {
            $titik = ".";
            $style_css = 'style="margin-left: -1.5rem;"';
            $class_ml = "";
          }

          $text_jawaban = '<tr>
                <td style="width:5px;">'.$v->no.$titik.'</td>
                <td style="">'.$v->soal.'</td>
            </tr>';

          if ($v->tipe_soal == 1) {
            $jawaban = DB::table("t_spaj_kuesioner_jawaban as a")->select("a.uraian")->where("a.id_kuesioner_soal",$v->id_kuesioner_soal)
                    ->where("a.id_spaj_kuesioner",$id_spaj_kuesioner)
                    ->where("a.deleted",1)->first();


            $text_jawaban .= '<tr>
                  <td></td>
                  <td style="border: 1px solid black; padding:5px;">'.$jawaban->uraian.'</td>
                </tr>';

          } elseif ($v->tipe_soal == 2) {
            $jawaban_db = DB::table("ref_kuesioner_jawaban as a")
                ->where("a.deleted",1)
                ->where("a.id_kuesioner_soal",$v->id_kuesioner_soal)
                ->orderBy("a.urutan","asc")
                ->get();

              $jawaban = DB::table("t_spaj_kuesioner_jawaban as a")
                    ->select("a.*")
                    ->where("a.id_kuesioner_soal",$v->id_kuesioner_soal)
                    ->where("a.id_spaj_kuesioner",$id_spaj_kuesioner)
                    ->where("a.deleted",1)->first();

              $text_jawaban2 = '';
              $text_wajib_dijelaskan = '';
              $text_jawaban_lanjut = '';
              $index = 0;
              foreach ($jawaban_db as $ke => $va) {
                $check = "";
                if ($va->id_kuesioner_jawaban == $jawaban->id_kuesioner_jawaban) {
                  $check = 'X';

                  if ($va->wajib_dijelaskan == 1) {
                    $text_wajib_dijelaskan = '<div style="margin-top:3px;">
                                      <div>'.$va->hint_dijelaskan.'</div>
                                  </div>
                                  <div style="">
                                      <div style="border:1px solid black; padding:5px;">'.htmlspecialchars($jawaban->uraian).'</div>
                                  </div>';
                  }
                }


                $steyle = '';
                if ($index > 0) {
                  $steyle = 'style="margin-left:20px;"';
                }
                $text_jawaban2 .= '<div class="kotak" '.$steyle.'>'.$check.'</div><span> '.htmlspecialchars($va->jawaban).'</span>';

                $index++;
              }

              $text_jawaban .= '<tr>
                  <td></td>
                  <td style="vertical-align:top;">
                    '.$text_jawaban2.'
                    '.$text_wajib_dijelaskan.'
                    '.$text_jawaban_lanjut.'
                  </td>
                </tr>';


          } elseif ($v->tipe_soal == 3) {

            $text_jawaban2 = '';
           $jawaban_db = DB::table("ref_kuesioner_jawaban as a")
                    ->where("a.deleted",1)
                    ->where("a.id_kuesioner_soal",$v->id_kuesioner_soal)
                    ->orderBy("a.urutan","asc")
                    ->get();

              $jawaban = DB::table("t_spaj_kuesioner_jawaban as a")
                    ->select("a.*")
                    ->where("a.id_kuesioner_soal",$v->id_kuesioner_soal)
                    ->where("a.id_spaj_kuesioner",$id_spaj_kuesioner)
                    ->where("a.deleted",1)->get();

              $jawaban_user_id = $jawaban->pluck('id_kuesioner_jawaban')->toArray();
              $uraian_user_id = $jawaban->pluck('uraian','id_kuesioner_jawaban')->toArray();
              $id_jawaban_user_id = $jawaban->pluck('id','id_kuesioner_jawaban')->toArray();

              $index = 0;
              foreach ($jawaban_db as $ke => $va) {
                $check_no = "X";
                $check_yes = "";
                $uraian_user = "";
                if (in_array($va->id_kuesioner_jawaban, $jawaban_user_id)) {
                  $check_no = "";
                  $check_yes = "X";
                  $uraian_user = $uraian_user_id[$va->id_kuesioner_jawaban];
                  $arr_t_spaj_kuesioner_jawaban_id[] = $id_jawaban_user_id[$va->id_kuesioner_jawaban];

                }


                if ($va->wajib_dijelaskan == 1) {
                    $text_jawaban1 = '<div style="margin-bottom:5px;">
                              <span>'.$arr_abjad[$index].'. '.$va->jawaban.'</span>
                              <div class="kotak" style="margin-left:40px;">'.$check_yes.'</div><span> Ya, Jelaskan</span>
                              <div class="kotak" style="margin-left:20px;">'.$check_no.'</div><span> Tidak</span>
                              <div style="">
                                  <div style="border-bottom:1px solid black; border-top:1px solid black; padding:5px;">'.$uraian_user.'</div>
                              </div>
                            </div>';
                  } else {
                    $text_jawaban1 = '<div style="margin-bottom:5px;">
                            <span>'.$arr_abjad[$index].'. '.$va->jawaban.'</span>
                            <div class="kotak" style="margin-left:40px;">'.$check_yes.'</div><span> Ya</span>
                            <div class="kotak" style="margin-left:20px;">'.$check_no.'</div><span> Tidak</span>
                          </div>';
                  }

                  $text_jawaban2 .= $text_jawaban1;

                  $index++;
              }         

              $text_jawaban .= '<tr>
                  <td></td>
                  <td style="vertical-align:top;">'
                  .$text_jawaban2.
                  '</td>
                </tr>';

          } elseif ($v->tipe_soal == 4) {
            $text_jawaban1 = "";
            $jawaban = DB::table("t_spaj_kuesioner_jawaban as a")
                      ->select("a.id","a.uraian","b.multidata","a.id_kuesioner_jawaban")
                      ->leftJoin("ref_kuesioner_soal as b", function($join)
                                {
                                     $join->on('a.id_kuesioner_soal', '=', 'b.id_kuesioner_soal');
                                     $join->on('b.deleted','=', DB::raw(1));
                                })
                                ->where("a.id_spaj_kuesioner",$id_spaj_kuesioner)
                                ->where("a.deleted",1)
                                ->where("a.id_kuesioner_soal",$v->id_kuesioner_soal)->first();

            if ($jawaban) {
              $arr_t_spaj_kuesioner_jawaban_id[] = $jawaban->id;
              $multidata = json_decode($jawaban->multidata);
              $multidata = $multidata->kolom;

              $uraian = json_decode($jawaban->uraian);

                  // print_r($multidata);

              $td_head = "";
              $td_body = "";
              $c_multidata = count($multidata);

              foreach ($multidata as $ki => $vi) {
                $td_head .= '<th class="text-center" style="border:2px solid black; border-collapse:collapse; background-color:#c2c2c2;">'.$vi->label.'</th>';
                $field = $vi->field;
              }

              foreach ($uraian as $ke => $ve) {
                $text_fild = '';
                foreach ($multidata as $ko => $vo) {
                  $field = $vo->field;
                  $text_fild .= '<td style="border:2px solid black; border-collapse:collapse;padding:3px;">'.$ve->$field.'</td>';
                }
                $td_body .= '<tr>'.$text_fild.'</tr>';
              }

              $text_jawaban1 .= '<table class="table-border" style="border:2px solid black; border-collapse:collapse;">
                <tr>
                  '.$td_head.'
                  
                </tr>
                '.$td_body.'
              </table>';
            }

            
            
            $text_jawaban .= '<tr>
              <td></td>
              <td style="vertical-align:top;">'.$text_jawaban1.'</td></tr>';
          } elseif ($v->tipe_soal == 5) {
            $jawaban = DB::table("t_spaj_kuesioner_jawaban as a")->select("a.uraian")->where("a.id_kuesioner_soal",$v->id_kuesioner_soal)
                    ->where("a.id_spaj_kuesioner",$id_spaj_kuesioner)
                    ->where("a.deleted",1)->first();


            $text_jawaban .= '<tr>
                  <td></td>
                  <td style="border: 1px solid black; padding:5px;">'.$jawaban->uraian.'</td>
                </tr>';

          }

          return $text_jawaban;
      }

      
    }


    if (! function_exists('convert_null_to_0')) {
      function convert_null_to_0($string)
      {
        if ($string == "") {
            $string = 0;
        } 

        return $string;
      }
    }
    