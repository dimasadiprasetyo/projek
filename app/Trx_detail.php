<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trx_detail extends Model
{
    use SoftDeletes;
    protected $primaryKey = 'id_trx';
    protected $keyType = 'char';
    protected $table = 'trx_details';
    public $incrementing = false;
    protected $fillable = ['id_trx','barang_id','qty','diskon','total_harga','created_at','updated_at'];

    public function barang(){
        return  $this->belongsTo('App\barang','barang_id','kode_barang');
    }
    public function Pelanggan(){
        return  $this->belongsTo('App\Pelanggan','kode_pelanggan','kode_pelanggan');
    }
    public function Trx_header(){
        return  $this->hasMany('App\Trx_header','id','id_trx');
    }
    public function Angsuran(){
        return  $this->hasMany('App\Angsuran','kode_angsuran','id_trx');
    }
    public function Lappenn(){
        return  $this->hasMany('App\Lappen');
    }
    
}
