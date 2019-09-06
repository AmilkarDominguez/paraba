<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('state', ['ACTIVO', 'INACTIVO','ELIMINADO'])->default('ACTIVO');
            //CUSTOM
            $table->string('name');
            $table->mediumText('description')->nullable();
            $table->string('photo')->nullable();
            $table->text('link')->nullable();
            $table->text('link2')->nullable();
            $table->unsignedBigInteger('transport_type_id')->unsigned()->nullable();
            $table->unsignedBigInteger('language_id')->unsigned()->nullable();
            $table->timestamps();
            //RELATIONS
            $table->foreign('transport_type_id')->references('id')->on('catalogues')
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
        Schema::dropIfExists('transports');
    }
}
