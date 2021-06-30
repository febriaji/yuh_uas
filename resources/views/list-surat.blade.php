<span class="d-block p-2 bg-dark text-white">
  <h3 style="text-align: center">Daftar Surat Keluar</h3>
</span><br>
<div class="container">
  <form action="{{ route('logout') }}" method="POST">
  <a class="btn btn-primary" href="/tambah-surat"> Tambah</a>
  <a class="btn btn-primary" href="/cetak"> PaDF</a>
  <input type="submit" value="Keluar" class="btn btn-primary">


  
  
</div><br>
<style>
    table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
      text-align: center;
    }
    /* h1 {
      font-family: arial, sans-serif;
    }
    
    td, th {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
    }
    
    tr:nth-child(even) {
      background-color: #dddddd;
    } */
    </style>
<div class="container">
  <div class="card border-dark mb-3">
<table class="table">
  <thead class="thead-dark">
    <tr>
    <th>Nomor Surat</th>
    <th>Tanggal Surat</th>
    <th>Judul Surat</th>
    <th>ACTION</th>
    </tr>
  </thead>
    @if (empty($data))
        <tr >
            <td class="alert alert-danger" role="alert" colspan="4">Data kosong</td>
        </tr>
    @endif
        @foreach($data as $j)
        <tbody>
        <tr>
            <td>{{ $j->nomor_surat}}</td> 
            <td>{{ $j->tanggal_surat}}</td> 
            <td>{{ $j->judul_surat}}</td>
            <td>
                <a class="btn btn-warning" href="/ubah-surat/{{$j->id}}">Edit</a>
                <a class="btn btn-danger" href="/hapus-surat/{{$j->id}}"> Hapus</a>
            </td>
        </tr>
        </tbody>
        @endforeach
  </table>
  </div>
</div>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

  