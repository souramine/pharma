<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVenteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vente', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date_vente');
            $table->integer('quantite_vendu');
            $table->float('prix');
            $table->unsignedInteger('pharmacien_id');
            $table->unsignedInteger('medicament_id');
            $table->timestamps();

            $table->foreign('pharmacien_id')->references('id')->on('pharmacies')->onDelete('cascade');
            $table->foreign('medicament_id')->references('id')->on('medicaments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vente');
    }
}
