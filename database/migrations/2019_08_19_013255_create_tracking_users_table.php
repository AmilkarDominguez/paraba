<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrackingUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tracking_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('state', ['ACTIVO', 'INACTIVO','ELIMINADO'])->default('ACTIVO');
            //CUSTOM
            $table->text('coordinates')->nullable();
            $table->unsignedBigInteger('user_id')->unsigned()->nullable();
            $table->timestamps();
            //RELATIONS
            $table->foreign('user_id')->references('id')->on('users')
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
        Schema::dropIfExists('tracking_users');
    }
}
