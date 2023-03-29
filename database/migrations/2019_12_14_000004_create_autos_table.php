<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Mogelijkheid om extra opties toe te voegen. Bijvoorbeeld verwaarmde stuur,.


        Schema::create('autos', function (Blueprint $table) {
            $table->id();
            $table->string('titel');
            $table->string('kenteken')->unique();
            $table->unsignedDecimal('vraagprijs');
            $table->text('omschrijving');
            $table->string('transmissie');
            $table->text('websites')->nullable();
            $table->string('BTW');
            $table->string('merk');
            $table->string('soort');
            $table->string('kleur');
            $table->string('type'); //handelsbenaming
            $table->unsignedInteger('bouwjaar');
            $table->string('carrosserie');
            $table->string('brandstof');
            $table->string('zuinigHeidsLabel');
            $table->float('netMaxVermogenElektrisch',6,2);
            $table->float('netMaxVermogen',6,2);
            $table->float('verbruik',5,2);
            $table->unsignedInteger('cilinderinhoud');
            $table->unsignedInteger('gewicht');
            $table->unsignedInteger('stoelen');
            $table->unsignedInteger('deuren');
            $table->date('apkVervaldatum');
            $table->text('extraAccessoires')->nullable();;
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
        Schema::dropIfExists('auto_files');
    }
}
