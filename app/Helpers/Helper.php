<?php
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;

use LaravelFCM\Facades\FCM;

use App\LogUser;
use App\Jobs\SendEmail;

function uploadOrUpdateImage($file, $fileName = null, $destinationPath = 'images/surat-komitmen')
{
    // $destinationPath = 'images/article/thumbnail/'.\Auth::user()->web;

    if(!is_dir(public_path($destinationPath))) {
        mkdir(public_path($destinationPath), 0777, true);
    }

    if($file) {
        if($fileName) {
            if(file_exists(public_path($fileName))) {
                \unlink(public_path($fileName));
            }
        }

        // $file = $request->file('surat_komitmen');
        $fileName = time().'.'.$file->getClientOriginalExtension();
        $fileExtension = \File::extension($fileName);
        $fileNameWithExtension = $fileName;
        // $file->move($destinationPath, $fileNameWithExtension);
        $img = Image::make($file->getRealPath());
        $img->save(public_path($destinationPath).'/'.$fileNameWithExtension);

        $fileName = $destinationPath.'/'.$fileNameWithExtension;
    }

    return $fileName;
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

function html_cut($text, $max_length)
{
    return substr(strip_tags($text),0,$max_length);
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

    if (! function_exists('convert_null_to_0')) {
      function convert_null_to_0($string)
      {
        if ($string == "") {
            $string = 0;
        } 

        return $string;
      }
    }

    function status_arisan($id_status)
    {
      $status = [
        ['batal', 'badge badge-danger'],
        ['menunggu', 'badge badge-warning'],
        ['aktif', 'badge badge-info'],
        ['selesai', 'badge badge-success'],
      ];

      return $status[$id_status];
    }
    