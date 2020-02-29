<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientAppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_apps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('appId')->unique();
            $table->string('appName')->nullable();
            $table->string('appEmail')->nullable();
            $table->string('appKey');
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
        Schema::dropIfExists('client_apps');
    }
}
