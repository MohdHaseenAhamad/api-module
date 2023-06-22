<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class GurStudent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('gur_student',function (Blueprint $table)
       {
           $table->id();
           $table->string('usr_name');
           $table->string('usr_email')->unique();
           $table->string('usr_phone');
           $table->integer('usr_status');
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
        Schema::dropIfExists('gur_student');
    }
}
