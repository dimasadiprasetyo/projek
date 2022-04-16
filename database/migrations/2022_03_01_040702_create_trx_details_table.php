<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrxDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trx_details', function (Blueprint $table) {
            $table->id();
            $table->char('id_trx',17);
            $table->string('barang_id');
            $table->bigInteger('qty');
            $table->bigInteger('diskon');
            $table->bigInteger('total_harga');
            $table->timestamps();

            $table->foreign('barang_id')->references('kode_barang')->on('barangs');
            // $table->foreign('id_trx')->references('id_trx')->on('trx_headers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trx_details');
    }
}
