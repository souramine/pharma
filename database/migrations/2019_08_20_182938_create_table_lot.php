<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableLot extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lot', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date_fabrication');
            $table->date('date_peremption');
            $table->date('date_achat');
            $table->integer('quantite_acheter');
            $table->integer('quantite_restante');
            $table->integer('quantite_minimum')->default(0);
            $table->float('prix');
            $table->unsignedInteger('pharmacien_id');
            $table->unsignedInteger('fournisseur_id');
            $table->unsignedInteger('medicament_id');
            $table->timestamps();

            $table->foreign('pharmacien_id')->references('id')->on('pharmacies')->onDelete('cascade');
            $table->foreign('fournisseur_id')->references('id')->on('fournisseurs')->onDelete('cascade');
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
        Schema::dropIfExists('lot');
    }
}
