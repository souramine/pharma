<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePharmacieTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pharmacies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->string('email', 50)->unique();
            $table->string('numero',20)->unique();
            $table->date('naissance', 50);
            $table->string('adresse', 80);
            $table->string('hopital', 30)->default("Centre Hospitalier Tlemcen");
            $table->string('service', 30)->default("Neurologie");
            $table->string('grade', 30)->nullable();
            $table->string('spe', 30)->nullable();
            $table->boolean('admin');
            $table->string('password', 200);
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
        Schema::dropIfExists('pharmacies');
    }
}
