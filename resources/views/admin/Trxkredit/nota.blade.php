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
      body {
           padding: 5px;
           position: relative;
           width: 100%;
           height: 100%;
           font-family: 'Times New Roman', Times, serif;
       }
       table {
           font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
               border-collapse: collapse;
               width: 100%;
               border: 1px solid #000000;
       }
       table, th, td{
           padding: 7px 10px;
           
       }
       table .tr1 th{
               background: #111111;
               color: #fff;
               font-weight: normal;
               text-align: center;
       }
       table .tr2 td{
               background: #111111;
               color: #fff;
               font-weight: normal;
       }
       table .kop:before {
         content: ': ';
       }
       

   </style>
</head>
<body>
    
    <img src="LJA.jpg" style="float: left; height: 70px width: 80px">
    <div style="margin-left: 16px">
          <div style="font-size: 18px"> MATERIAL KAYU LANCAR JAYA</div>
          {{-- <div style="font-size: 20px"> LANCAR JAYA</div> --}}
          <div style="font-size: 13px"> Jl. Mayjend Sutoyo, Denasri Kulon -Batang</div>
          <div style="font-size: 13px"> Telepon : 0815427890,0989318636</div>
    </div>
    <br>
  <div id="printable">
    {{-- <hr style="border: 0.5px solid black; margin: 10px 5px 10px 5px;"> --}}
    <h3 align="center">Nota Penjualan</h3>
    {{-- <hr style="border: 0.2px solid black; margin: 10px 5px 10px 5px;"> --}}
    <table border="0" cellpadding="0" cellspacing="0" width="200" class="border" style="overflow-x:auto;">
        <thead>
          <tr>
            <td colspan="1" class="left">No. Transaksi</td>
            <td class="left kop">{{$id_trx}}</td>
            <td></td>
            <td  class="left">Tanggal</td>
            <td colspan="3" class="left kop">{{date('d-m-Y',strtotime($tgl_trx))}}</td>
          </tr>
          <tr>
            <td  class="left">Customer</td>
            <td class="left kop">{{$kode_pelanggan}}</td>
            <td></td>
            <td  class="left">Tanggal Jatuh Tempo</td>
            <td colspan="3" class="left kop">{{date('d-m-Y',strtotime($tgl_jatuhtemp))}}</td>
          </tr>
          <tr>
            <td  class="left">Alamat</td>
            <td  class="left kop">{{$alamat}} /</td>
            <td></td>
            <td  class="left">Keterangan</td>
            <td colspan="3" class="left kop">{{$keterangan}}</td>
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td colspan="3"></td>
          </tr>
        </thead>
        <tbody>
          <tr class="tr1" style="width: 7px; text-align: center">
            <th class="th1" style="width: 7px">No</th>
            <th>Nama Barang</th>
            <th>Ukuran Barang</th>
            <th>Qty</th>
            <th>Harga</th>
            <th>Diskon</th>
            <th>Total</th>
          </tr>
          @foreach ($transaksidetail as $detail)
          <tr>  
            <td>{{$loop->iteration}}</td>
            <td>{{$detail->barang->jenis_barang}}</td>
            <td>{{$detail->barang->ukuran_barang}}</td>
            <td>{{$detail->qty}}</td>
            <td>Rp.{{number_format($detail->barang->harga,0,',','.')}}</td>
            <td>Rp.{{number_format($detail->diskon,0,',','.')}}</td>
            <td>Rp.{{number_format($detail->total_harga,0,',','.')}}</td>    
          </tr>
          @endforeach
          <tr>
            <th colspan="6" class="tr2" style="text-align: right; background-color: #830000;color: white"> Uang Muka</th>
            <td style="color: rgb(255, 255, 255); background-color: rgb(160, 10, 10)">Rp.{{number_format($uangmuka,0,',','.')}}</td>
          </tr>

          <tr>
            <th colspan="6" class="tr2" style="text-align: right; background-color: #000000;color: white"> Sisa yang harus dibayar</th>
            <td style="color: rgb(255, 255, 255);background-color: rgb(160, 10, 10)">Rp.{{number_format($total_bayar,0,',','.')}}</td>
          </tr>

          <tr>
            <th colspan="6" class="tr2" style="text-align: right; background-color: #000000;color: white"> Ongkos Kirim</th>
            <td style="color: rgb(255, 255, 255);background-color: rgb(160, 10, 10)">{{$ongkir}}</td>
          </tr>

          <tr>
            <th colspan="6" class="tr2" style="text-align: right; background-color: #000000;color: white"> Subtotal</th>
            <td style="background-color: red;color: rgb(255, 255, 255)">Rp.{{number_format($subtotal,0,',','.')}}</td>
          </tr>

        </tbody>
        <tfoot>
          <tr>
            <td colspan="2" style="color: red"> Perhatian : Barang yang sudah dibeli tidak bisa dikembalikan & Pembelian baru harga baru</td>
            <td colspan="1"></td>
            <td colspan="1"></td>
            <td colspan="2"></td>
            <td></td>
          </tr>
          <tr >
            <td></td>
            <td colspan="1"></td>
            <td colspan="2"></td>
            <td colspan="2"></td>
            <td></td>
          </tr>
        </tfoot>
        <tfoot>
          <tr>
            <td></td>
            <td colspan="1"></td>
            <td colspan="2"></td>
            <td colspan="2"></td>
            <td></td>
          </tr>
          <tr class="ttd">
            <th></th>
            <th colspan="1">Customer</th>
            <th colspan="2"></th>
            <th colspan="2">Hormat Kami</th>
            <th></th>
          </tr>
          <tr >
            <td></td>
            <td colspan="1"></td>
            <td colspan="2"></td>
            <td colspan="2"></td>
            <td></td>
          </tr>
          <tr >
            <td></td>
            <td colspan="1"></td>
            <td colspan="2"></td>
            <td colspan="2"></td>
            <td></td>
          </tr>
          <tr>
            <td></td>
            <td style="text-align: center" >({{$kode_pelanggan}})</td>
            <td colspan="2"></td>
            <td colspan="2" style="text-align: center">(Lancar Jaya)</td>
            <td></td>
          </tr>
        </tfoot>
    </table>
  </div>

</body>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</html>