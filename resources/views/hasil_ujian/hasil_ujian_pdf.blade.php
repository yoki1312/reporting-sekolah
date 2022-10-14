<!DOCTYPE html>
<html>
<head>
	<title>Laporan Hasil Ujian</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<center>
		<h5>Laporan Hasil Ujian</h4>
        <br>
        <hr>
	</center>
 
	<table class='table table-bordered table-sm'>
		<thead>
			<tr style="text-align:center">
				<th>No</th>
				<th>Nama Peserta</th>
				<th>Nip</th>
				<th>Nama Sekolah</th>
				<th>Jenjang</th>
				<th>Kecamatan</th>
				<th>Nilai</th>
			</tr>
		</thead>
		<tbody>
			@php $i=1; $total = 0; @endphp
			@foreach($data as $p)
			<tr>
				<td style="text-align:center">{{ $i++ }}</td>
				<td>{{$p->nama_user}}</td>
				<td>{{$p->nip}}</td>
				<td>{{$p->nama_sekolahan}}</td>
				<td style="text-align:center">{{$p->nama_jenjang}}</td>
				<td>{{$p->nama_kecamatan}}</td>
				<td style="text-align:center">{{$p->total_nilai}}</td>
			</tr>
            @php $total += $p->total_nilai @endphp
			@endforeach
            <tr>
                <td colspan="6" style="text-align:center">Total Nilai</td>
                <td style="text-align:center">{{ $total }}</td>
            </tr>
		</tbody>
	</table>
 
</body>
</html>