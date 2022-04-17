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
        <div style="font-size: 17px"> JURNAL UMUM</div>
        <div style="font-size: 17px"> Per 23 Agustus 2013</div>
    </div>
    <br>
<div id="printable">
    <table class="table table-bordered " border="3" >
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Keterangan</th>
            <th>Reff</th>
            <th>Debet</th>
            <th>Kredit</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($akuns as $akun)
            @foreach ($Jurnalheader as $header)
                @foreach ($header->jurnal_detail as $detail)
                    @php
                        $jurnal = $detail->id_jurnal;
                    @endphp
                @endforeach
                    {{-- @if($detail->id_akun == $akun->id_akun) --}}
                <tr>
                    <td rowspan="3" style="text-align: center valign">{{$header->tanggal}}</td>
                    <td>{{$akun->nama_akun}}</td>
                    <td>-</td>
                    <td>{{$detail->debit}}</td>
                    <td>{{$detail->kredit}}</td>
                </tr>
                <tr>
                    <td>{{$akun->nama_akun}}</td>
                    <td>-</td>
                    <td>{{$detail->debit}}</td>
                    <td>{{$detail->kredit}}</td>
                </tr>
                <tr>
                    <td >A</td>
                    <td>-</td>
                    <td>C</td>
                    <td>D</td>
                </tr>
                    {{-- @endif --}}
            @endforeach
        @endforeach
    </tbody>
    </table>
</div>

</body>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</html>