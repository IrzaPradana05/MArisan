@extends('pdf.surat-tindak.main')
@section('content')
<div class="header clearfix">
 <div id="logo">
    <img src="data:image/jpg;base64, {{$img}}" alt="logo">
  </div>
</div>
<br><br><br>
<div class="main">
	<div> 
		<p style="border-bottom:3px solid black; width:100%;"></p><br>
		<p class="text-center"><b>SURAT PANGGILAN ORANG TUA</b></p><br>
		<div class="font-13">
		  	<table class="tabel_1"  style="table-layout: fixed;">
			    <!-- <tr class="">
			      	<td style="width: 25%">Nomor Polis</td>
			      	<td style="width: 1%">:</td>
			      	<td style="">
			      		<div style="border-bottom:1px solid black;padding:1px;width:100%;">kjsdfhjskdhf</div>
			      	</td>
			    </tr>
			    <tr class="">
			      	<td>Nama Pemegang Polis</td>
			      	<td>:</td>
			      	<td style="">
			      		<div style="border-bottom:1px solid black;padding:1px;width:100%;">sdfhjdsk skdjhf</div>
			      	</td>
			    </tr>
			    <tr class="">
			      	<td>Nama Tertanggung</td>
			      	<td>:</td>
			      	<td style="">
			      		<div style="border-bottom:1px solid black;padding:1px;width:100%;">kjdhfjkds dksjhfjsd</div>
			      	</td>
			    </tr> -->
			    <tr class="">
			      	<td>Perihal : Undangan</td>
			      	<td style="">
			      		<table style="width: 100%; border-spacing: 0; border-collapse: collapse;">
			      			<tr>
						      	<td>
			      					<div style="padding:1px;padding-left:35%;">Nganjuk, {{format_tanggal(date('Y-m-d'),true,false)}}</div>
			      				</td>
			      			</tr>
			      		</table>
			      	</td>
			    </tr>
			</table>
		</div>
		<br>
		<p class="font-13">Kepada</p>
		<div style="padding-left:8%;">
			<p class="font-13">Yth, Bapak/Ibu Orang Tua/Wali Siswa</p>
			<p class="font-13">{{ucwords($data['nama'])}}</p>
			<p class="font-13">Kelas {{$data['kelas']}}</p>
			<p class="font-13">di Tempat</p>
		</div>

		<br>
		<p class="font-13">
			Dengan Hormat,<br><br>
			Sehubungan dengan adanya sesuatu yang perlu disampaikan kepada Bapak/Ibu, maka Kami mengundang Bapak/Ibu untuk hadir pada:
		</p>
		<div style="padding-left:8%;">
			<table class="tabel_1 text-justify font-13" style="table-layout: fixed;">
				<tr>
					<td style="vertical-align:top; width: 15%">Hari</td>
					<td style="vertical-align:top; width: 2%">:</td>
					<td>{{ucfirst($data['hari'])}}</td>
				</tr>
				<tr>
					<td style="vertical-align:top; width: 15%">Tanggal</td>
					<td style="vertical-align:top; width: 2%">:</td>
					<td>{{format_tanggal($data['tanggal'],true,false)}}</td>
				</tr>
				<tr>
					<td style="vertical-align:top; width: 15%">Jam</td>
					<td style="vertical-align:top; width: 2%">:</td>
					<td>{{$data['jam']}}</td>
				</tr>
				<tr>
					<td style="vertical-align:top; width: 15%">Tempat</td>
					<td style="vertical-align:top; width: 2%">:</td>
					<td>{{$data['tempat']}}</td>
				</tr>
			</table>
		</div>
		<br>
		<p class="font-13">
			Mengingat sangat pentingnya hal di atas dimohon Bapak/Ibu bersedia hadir tepat waktu. Atas perhatian<br>dan kehadirannya Kami sampaikan terimakasih.
		</p>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<p class="font-13" style="padding-left:80%;">Konselor Sekolah</p>
	</div>

</div>
@endsection