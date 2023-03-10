<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" > --}}
    <link rel="stylesheet" href="{{asset('asset/dist/css/bootstrap.min.css')}}" >
    <title>Document</title>
    <style>
        table {
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
            font-size: 13px;
            border: 1px solid #000000;
        }
        table, th, td{
                padding: 7px 10px;
                text-align: center;
        }        
        table .tr1 th{
                background: #111111;
                color: #fff;
                font-weight: normal;
            }
        table tr:hover {
            background-color: #8b1818;
        }
        table tr:nth-child(even) {
            background-color: #d3d3d3;
        }
    </style>
</head>
<body>
    
    <img src="LJA.jpg" style="float: left; height: 70px width: 80px; margin:auto">
    <div style="margin-left: 16px">
        <div style="font-size: 17px"> MATERIAL KAYU LANCAR JAYA</div>
        {{-- <div style="font-size: 20px"> LANCAR JAYA</div> --}}
        <div style="font-size: 14px"><strong> LAPORAN BUKU BESAR </strong></div>
        <div style="font-size: 15px; text-align: left "> Periode {{$monthName}} {{$year}}</div>
    </div>
    <br>
    <br>
<div id="printable">
    @foreach($akuns as $akun)
        <div style="margin-top: 50px; margin-bottom: -35px">
            <div class="card">
                <div class="card-body">
                    <div class="row mt-6">
                        <div class="col-8">
                            <span class="text-left" style="font-size: 18px">Nama Akun : {{$akun->nama_akun}} </span>
                        </div>
                        <div class="col-6">
                            <span class="text-right" style="font-size: 18px">No Akun : {{$akun->id_akun}} </span>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-stripped" border="1">
                            <thead>
                                <tr style="font-size: 17px" class="tr1">
                                    <th>Tanggal</th>
                                    <th>Keterangan</th>
                                    <th>Reff</th>
                                    <th style="text-align: right">Debit</th>
                                    <th style="text-align: right">Kredit</th>
                                    <th style="text-align: right">Saldo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total = 0; @endphp
                                @foreach($Jurnalheader as $header)
                                    @foreach($header->jurnal_detail as $detail)
                                        @if($detail->id_akun == $akun->id_akun) 
                                            <tr>
                                                <td>{{date('d/m/y',strtotime($header->tanggal))}}</td>
                                                <td>{{$header->keterangan}}</td>
                                                <td>{{$detail->id_jurnal}}</td>
                                                <td style="text-align: right">Rp.{{number_format($detail->debit,0,',','.')}}</td>
                                                <td style="text-align: right">Rp.{{number_format($detail->kredit,0,',','.')}}</td>
                                                <td style="text-align: right">Rp.{{number_format($total +=($detail->debit - $detail->kredit),0,',','.')}}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
<br>
<br>
<div style="text-align: center; width: 900px">
    <span style="width: 20px">Batang, {{$tgl}}</span>
    <br>
    <span style="width: 20px">Tanda Tangan</span>
        <br>
        <br>
        <br>
        <br>
        <br>
    <span style="width: 27px">( Rifki Ivanda )</span>
</div>

</body>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</html>