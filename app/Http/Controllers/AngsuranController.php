<?php

namespace App\Http\Controllers;

use App\Angsuran;
use App\Pelanggan;
use App\Trx_detail;
use App\Trx_header;
use PDF;
use Illuminate\Http\Request;

class AngsuranController extends Controller
{
    //index
    public function index(){
        $pelanggan = Pelanggan::all();        
        $Trxheader = Trx_header::where('jenis_transaksi','=', 'Kredit')->where('status_trx','=','Belum Lunas')->with('Pelanggan','Trx_detail')->get();
        // dd($Trxheader);
        return view('admin.Angsuran.index', compact('Trxheader'));
    }

    //bayarindex
    public function indexbayar($id_trx){
        // dd($request->all());

        $angsuran = Angsuran::where('id_trx', $id_trx)->get();
        $Trxheader = Trx_header::where('id_trx','=', $id_trx)->with('Pelanggan','Trx_detail','barang')->first();
        // dd($Trxheader);

        $tglInput = date('Y-m-d');
        $tgl=date('dmYHis'); 
        $id_asr = "ASR-".$tgl;
        return view('admin.Angsuran.bayarindex', compact('Trxheader','tglInput','id_asr','angsuran', 'id_trx'));
    }
    
    //store/tambah
    public function store(Request $request, $id_trx){
        $trxHeader = Trx_header::where('id_trx', $request->id_trx)->first();
        $updateKurangBayarHeader =  reverseRupiah($trxHeader->kurang_bayar) - reverseRupiah($request->bayar);
            if($updateKurangBayarHeader < 0){
                return redirect()->route('bayarindex.index',$id_trx)
                                ->with('message','Maaf, Bayar Angsuran melebihi Piutang!!!');
            }

        Angsuran::create([
            'kode_angsuran'=>$request->kode_angsuran,
            'tanggal_ang'=>$request->tanggal_ang,
            'id_trx'=>$request->id_trx,
            'angsuran_ke'=>$request->ang_ke,
            'jml_bayar'=>reverseRupiah($request->bayar),
            'kurang_bayar'=>reverseRupiah($request->kurang_bayar),
        ]);

        //eror update

        if($updateKurangBayarHeader == 0){
            $updateStatusHeader = 'Lunas';
        } else {
            $updateStatusHeader = 'Belum Lunas';
        }
        $trxHeader->update([
            'kurang_bayar' => $updateKurangBayarHeader,
            'status_trx' => $updateStatusHeader
        ]);
        
        return redirect(route('bayarindex.index',$id_trx))->withToastSuccess("Data Berhasil Ditambahkan");
    }

    //print dp
    public function cetakdp($id_trx){
        $Trxcetak = Trx_header::where("id_trx",'=',$id_trx)->with('Pelanggan')->first();
        // dd($Trxcetak);
        
        $pdf = PDF::loadview('admin.angsuran.cetakdp', compact('Trxcetak'))->setPaper('F4', 'portrait');
        return $pdf->stream();
    }

    //print out
    public function cetak($kode_angsuran){
        $angsurancetak = Angsuran::where("kode_angsuran",'=',$kode_angsuran)->with('Trx_detail')->first();
        $Trxheader = Trx_header::all();
        $Pelanggan = Pelanggan::all();
        // // dd($Trxheader);
        
        // // dd($angsurancetak);
        foreach ($angsurancetak as $cetak) {
            foreach ($Trxheader as $header) {
                if ($cetak == $header->id_trx) {
                    foreach ($Pelanggan as $pelanggan) {
                        if ($header->kode_pelanggan == $pelanggan->kode_pelanggan) {
                            $no = $kode_angsuran;
                            $id = $header->id_trx;
                            $yth = $pelanggan->nama_pelanggan;

                        }
                    }
                }
            }
        }
        $pdf = PDF::loadview('admin.angsuran.cetak',compact('angsurancetak','no','yth','id'))->setPaper('A4','potrait');
        return $pdf->stream();
    }

    //destroy/hapus
    public function destroy(Angsuran $angsuran){
        //
    }
}
