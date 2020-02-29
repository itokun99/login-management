<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientCredentialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        Schema::create('client_credentials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('appId');
            $table->string('type');
            $table->string('credential');
            $table->timestamps();
        });

        Schema::table('client_credentials', function (Blueprint $table) {
            $table->foreign('appId')->references('appId')->on('client_apps');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_credentials');
    }
}
