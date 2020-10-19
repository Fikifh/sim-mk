<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransIndikatoriKinerjasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trans_indikatori_kinerjas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('users_id')->unsigned();            
            $table->bigInteger('id_indikator_kerjas')->unsigned(); 
            $table->integer('ak_realisasi');
            $table->integer('qtt_realisasi');
            $table->integer('mutu_realisasi');                                   
            $table->timestamps();

            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_indikator_kerjas')->references('id')->on('indikator_kerjas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trans_indikatori_kinerjas');
    }
}
