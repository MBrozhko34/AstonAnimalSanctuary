<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdoptionRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adoption_requests', function (Blueprint $table) {
          $table->id();
          $table->bigInteger('user_id')->unsigned()->nullable();
          $table->string('owner_name', 30);
          $table->bigInteger('animal_id')->unsigned()->nullable();
          $table->string('animal_name', 30);
          $table->enum('state',['Accepted', 'Declined','Pending'])->default('Pending');
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
        Schema::dropIfExists('adoption_requests');
    }
}
