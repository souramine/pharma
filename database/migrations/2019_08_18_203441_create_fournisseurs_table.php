<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFournisseursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fournisseurs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->date('naissance', 50);
            $table->string('mail', 50)->unique();
            $table->string('numero_tel',15)->unique();
            $table->string('numero_reg',30)->unique();
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
        Schema::create('fournisseurs', function (Blueprint $table) {
            Schema::dropIfExists('fournisseurs');
        });
    }
}
