<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('code_pesanan')->nullable();
            $table->bigInteger('customer_id')->nullable()->default(12);
            $table->string('nama_produk', 100);
            $table->integer('jumlah');
            $table->integer('harga');
            $table->string('pemesan', 100);
            $table->string('no_hp', 200);
            $table->string('alamat', 200);
            $table->string('status_pembayaran', 50);
            $table->string('bukti_pembayaran', 150);
            $table->string('keterangan', 50);
            $table->string('gambar', 200);
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
        Schema::dropIfExists('pesanans');
    }
}
