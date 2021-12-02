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
		<p class="text-center"><b>SURAT SKORSING</b></p><br>
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
			      	<td>Perihal : Pemberitahuan Skorsing</td>
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

		<p class="font-13">
			Yang bertanda tangan di bawah ini Kepala SMK Negeri 1 Bagor memberitahukan bahwa, sehubungan dengan pelanggaran tata tertib sekolah yang dilakukan oleh Putra / Putri Bapak / Ibu : 
		</p>
		<div style="padding-left:8%;">
			<table class="tabel_1 text-justify font-13" style="table-layout: fixed;">
				<tr>
					<td style="vertical-align:top; width: 15%">Nama</td>
					<td style="vertical-align:top; width: 2%">:</td>
					<td>{{ucwords($data['nama'])}}</td>
				</tr>
				<tr>
					<td style="vertical-align:top; width: 15%">Kelas</td>
					<td style="vertical-align:top; width: 2%">:</td>
					<td>{{$data['kelas']}}</td>
				</tr>
				<tr>
					<td style="vertical-align:top; width: 15%">NIS</td>
					<td style="vertical-align:top; width: 2%">:</td>
					<td>{{$data['nis']}}</td>
				</tr>
			</table>
		</div>
		<br>
		<p class="font-13">
			Maka dengan ini Kami pihak sekolah dengan sangat terpaksa memberikan skorsing kepada nama siswa tersebut di atas untuk tidak mengikuti kegiatan belajar mengajar di sekolah, terhitung dari tanggal {{format_tanggal($data['mulai_tanggal'],true,false)}} sampai dengan {{format_tanggal($data['sampai_tanggal'],true,false)}}. Dengan tujuan memberi sanksi kepada siswa atas pelanggaran yang dilakukan dan sekaligus memberikan kesempatan kepada Orang Tua siswa untuk lebih dekat dengan Putra/Putrinya dan memberikan pembinaan di rumah. <br><br>
			Demikian surat ini Kami sampaikan atas perhatian dan kerja sama dari Bapak/Ibu Kami sampaika terimakasih.
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
		<p class="font-13 text-center" style="padding-left:80%;">Kepala Sekolah<br>SMKN 1 Bagor</p>
	</div>

</div>
@endsection