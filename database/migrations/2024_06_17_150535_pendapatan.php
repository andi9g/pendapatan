<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pendapatan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->bigIncrements('idbarang');
            $table->integer('idkategori');
            $table->char('kdbarang',10);
            $table->double('hargabarang');
            $table->String('namabarang');
            $table->timestamps();
        });

        Schema::create('pemasukan', function (Blueprint $table) {
            $table->bigIncrements('idpemasukan');
            $table->date('tanggal');
            $table->bigInteger('iduser');
            $table->bigInteger('idbarang');
            $table->integer('jumlahbarang');
            $table->double('hargabarang');
            $table->String('metodepembayaran');
            $table->String('client');
            $table->timestamps();
        });

        Schema::create('kategori', function (Blueprint $table) {
            $table->bigIncrements('idkategori');
            $table->String('namakategori');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
