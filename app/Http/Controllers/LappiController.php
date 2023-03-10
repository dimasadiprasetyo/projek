<?php

namespace App\Http\Controllers;

use App\Angsuran;
use App\Lappi;
use App\Trx_header;
use PDF;
use Illuminate\Http\Request;

class LappiController extends Controller
{
    // Index Admin
    public function index(){
        return view('admin.Lappi.index');
    }

    // Index Pemilik
    public function indexpemilik(){
        return view('pemilik.Lappi.index');
    }
    
    // tampil Admin
    public function tampilindex(Request $request){   
        $month = $request->bulan;
	    $year = $request->tahun;
        $Trxheader = Trx_header::where('jenis_transaksi','=', 'Kredit')
        ->with('Pelanggan','Trx_detail','barang')
        ->whereYear('tgl_trx', '=', $year)
        ->whereMonth('tgl_trx', '=', $month)->get();
        $totalPiutang = 0;
        foreach($Trxheader as $trx) {
            $totalPiutang = $totalPiutang + $trx->kurang_bayar;
        }
        return view('admin.Lappi.tampil',compact('Trxheader', 'totalPiutang'));
    }

    // Tampil Pemilik
    public function tampilindexpemilik(Request $request){   
        $month = $request->bulan;
	    $year = $request->tahun;
        $Trxheader = Trx_header::where('jenis_transaksi','=', 'Kredit')
        ->with('Pelanggan','Trx_detail','barang')
        ->whereYear('tgl_trx', '=', $year)
        ->whereMonth('tgl_trx', '=', $month)->get();
        $totalPiutang = 0;
        foreach($Trxheader as $trx) {
            $totalPiutang = $totalPiutang + $trx->kurang_bayar;
        }
        return view('pemilik.Lappi.tampil',compact('Trxheader', 'totalPiutang'));
    }

    //print out
    public function cetak(Request $request){
        $month = $request->bulan;
	    $year = $request->tahun;
        $dataBulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        $selectedMonth = str_replace('0','',$month);
        $monthName = $dataBulan[$selectedMonth -1];
        
        $Trxheader = Trx_header::where('jenis_transaksi','=', 'Kredit')
        ->with('Pelanggan','Trx_detail','barang')
        ->whereYear('tgl_trx', '=', $year)
        ->whereMonth('tgl_trx', '=', $month)->get();
        $tgl = date('d-m-Y');
        $totalPiutang = 0;
        foreach($Trxheader as $trx) {
            $totalPiutang = $totalPiutang + $trx->kurang_bayar;
        }
        // foreach($Trxheader as $date){
        //     $dt = date('M Y',strtotime($date->tgl_trx));
        // }
        $pdf = PDF::loadview('admin.Lappi.cetak', compact('Trxheader', 'totalPiutang', 'monthName','year','tgl'))->setPaper('A4','potrait');
        return $pdf->stream();
    }
    
}
