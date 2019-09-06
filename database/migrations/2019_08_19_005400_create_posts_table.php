<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('state', ['ACTIVO', 'INACTIVO','ELIMINADO'])->default('ACTIVO');
            //CUSTOM
            $table->string('title')->nullable();
            $table->text('content')->nullable();
            $table->string('photo')->nullable();
            $table->text('link')->nullable();
            $table->text('link2')->nullable();
            $table->unsignedBigInteger('tag_id')->unsigned()->nullable();
            $table->unsignedBigInteger('language_id')->unsigned()->nullable();
            $table->timestamps();
            //RELATIONS
            $table->foreign('tag_id')->references('id')->on('catalogues')
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
        Schema::dropIfExists('posts');
    }
}
