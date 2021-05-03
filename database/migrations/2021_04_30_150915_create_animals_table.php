<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('userid')->unsigned()->nullable();
            $table->string('name', 8)->unique();
            $table->string('species', 30)->nullable();
            $table->float('DOB')->nullable();
            $table->string('description', 256)->nullable();
            $table->enum('available',['available', 'unavailable', 'adopted'])->default('unavailable')->nullable();
            $table->string('image', 256)->nullable();
            $table->timestamps();
            $table->foreign('userid')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('animals');
    }
}
