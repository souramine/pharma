<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicamentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicaments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom', 100);
            $table->float('dosage');
            $table->string('unite', 5);
            $table->string('forme', 100);
            $table->string('solvant', 100)->nullable();
            $table->float('volume', 100)->nullable();
            $table->string('unite_volume', 5)->nullable();
            $table->string('famille', 100);
            $table->string('voie', 20);
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
        Schema::dropIfExists('medicaments');
    }
}
