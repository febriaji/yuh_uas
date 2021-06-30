<!DOCTYPE html>
<html>
<head>
	<title>Data Pegawai</title>
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
		<h5>Laporan PDF Data Surat</h4>
		</h5>
		
	</center>
 
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No NIP</th>
				<th>NIP</th>
				<th>NAMA</th>
				<th>ALAMAT</th>
				<th>Gambar</th>
			</tr>
		</thead>
		<tbody>
			@php $i=1 @endphp
			@foreach($pegawai as $p)
			<tr>
				<td>{{ $i++ }}</td>
				<td>{{$p->nip}}</td>
				<td>{{$p->nama}}</td>
				<td>{{$p->alamat}}</td>
				<td>
					<img src="{{ public_path('data_file/'. $p->file) }}" style="width: 100px; height: 50px">
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
 
</body>
</html>