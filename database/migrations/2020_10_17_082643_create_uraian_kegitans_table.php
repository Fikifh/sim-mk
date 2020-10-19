<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUraianKegitansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uraian_kegitans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_indikator_kerjas')->unsigned();            
            $table->string('uraian_kegiatan');
            $table->integer('ak_target');
            $table->integer('qtt_target');
            $table->integer('mutu_target');              
            $table->timestamps();

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
        Schema::dropIfExists('uraian_kegitans');
    }
}
