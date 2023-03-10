<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" >
    {{-- <link rel="stylesheet" href="{{asset('asset/dist/css/bootstrap.min.css')}}" > --}}
    <title>Document</title>
    <style>
        table {
	max-width: 100%;
	max-height: 100%;
}
body {
	padding: 5px;
	position: relative;
	width: 100%;
	height: 100%;
}
table th,
table td {
	padding: .625em;
  text-align: center;
}
table .kop:before {
	content: ': ';
}
.left {
	text-align: left;
}
table #caption {
  font-size: 1.5em;
  margin: .5em 0 .75em;
}
table.border {
  width: 100%;
  border-collapse: collapse
}

table.border tbody th, table.border tbody td {
  border: thin solid #000;
  padding: 2px
}
.ttd td, .ttd th {
	padding-bottom: 4em;
}
    </style>
</head>
<body>
    
    <div style="text-align: center">
        <div style="font-size: 20px"> MATERIAL KAYU LANCAR JAYA</div>
        {{-- <div style="font-size: 20px"> LANCAR JAYA</div> --}}
        <div style="font-size: 17px"> LAPORAN PIUTANG</div>
        <div style="font-size: 17px"> Per {{$dt}}</div>
    </div>
    <br>
<div id="printable">
    <div class="container">
    <table class="table table-bordered " >
        <!--Judul Tabel -->
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Id Transaksi</th>
                <th>Nama Pelanggan</th>
                <th>Penjualan</th>
                <th>Total Bayar</th>
                <th>Saldo Piutang</th>
                <th>Status Piutang</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($Trxheader as $piutang)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{date('d-m-Y',strtotime($piutang->tgl_trx))}}</td>
                <td>{{$piutang->id_trx}}</td>
                <td>{{$piutang->Pelanggan->nama_pelanggan}}</td>
                <td>{{$piutang->jenis_transaksi}}</td>
                <td>{{$piutang->total_bayar}}</td>
                <td>{{$piutang->kurang_bayar}}</td>
                <td>{{$piutang->status_trx}}
                </td> 
            </tr>
                
            @endforeach
        </tbody>
        <tr>
            <td colspan="6" class="text-center"><b>Total Piutang</b></td>
            <td>{{$totalPiutang}}</td>
        </tr>
      
    </table>
</div>
</div>
</body>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</html>