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
		<p class="text-center"><b>SURAT PERNYATAAN</b></p><br>
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
			      	<td>Perihal : Pernyataan Drop Out</td>
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
			Yang bertanda tangan di bawah ini : 
		</p>
		<div style="padding-left:8%;">
			<table class="tabel_1 text-justify font-13" style="table-layout: fixed;">
				<tr>
					<td style="vertical-align:top; width: 15%">Nama</td>
					<td style="vertical-align:top; width: 2%">:</td>
					<td>Ahmad Zamrony, S.Pd.</td>
				</tr>
				<tr>
					<td style="vertical-align:top; width: 15%">Jabatan</td>
					<td style="vertical-align:top; width: 2%">:</td>
					<td>Kepala Sekolah SMK Negeri 1 Bagor</td>
				</tr>
				<tr>
					<td style="vertical-align:top; width: 15%">Alamat</td>
					<td style="vertical-align:top; width: 2%">:</td>
					<td>Jln. Delima Merah No.157</td>
				</tr>
			</table>
		</div>
		<br>
		<p class="font-13">
			Dengan ini menyatakan bahwa siswa yang bernama :
		</p>
		<div style="padding-left:8%;">
			<table class="tabel_1 text-justify font-13" style="table-layout: fixed;">
				<tr>
					<td style="vertical-align:top; width: 15%">Nama</td>
					<td style="vertical-align:top; width: 2%">:</td>
					<td>{{ucwords($data['nama'])}}</td>
				</tr>
				<tr>
					<td style="vertical-align:top; width: 15%">Sekolah</td>
					<td style="vertical-align:top; width: 2%">:</td>
					<td>SMK Negeri 1 Bagor</td>
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
			Mulai tanggal {{format_tanggal($data['tanggal'],true,false)}} dinyatakan keluar dari sekolah SMK Negeri 1 Bagor atas<br>permintaan dari pihak sekolah / orang tuanya. <br><br>
			Demikian peryataan Kami, atas perhatian dan kerja samanya selama ini Kami sampaikan terimakasih yang sebesar-besarnya.
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
		<p class="font-13 text-center" style="padding-left:70%;">Ahmad Zamrony, S.Pd.</p>
	</div>

</div>
@endsection