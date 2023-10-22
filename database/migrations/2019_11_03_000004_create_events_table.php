<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->string('phone');
            $table->string('name_service');

            $table->datetime('start_time');

            $table->date('date');

            $table->datetime('end_time');

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
