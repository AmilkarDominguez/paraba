<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            //CUSTOM
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('photo')->nullable();
            $table->text('link')->nullable();
            $table->string('coordinates')->nullable();
            $table->enum('state', ['ACTIVO', 'INACTIVO','ELIMINADO'])->default('ACTIVO');
            $table->unsignedBigInteger('location_type_id')->unsigned()->nullable();
            $table->unsignedBigInteger('language_id')->unsigned()->nullable();
            //RELATIONS
            $table->foreign('location_type_id')->references('id')->on('catalogues')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreign('language_id')->references('id')->on('catalogues')
            ->onDelete('cascade')
            ->onUpdate('cascade');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locations');
    }
}
