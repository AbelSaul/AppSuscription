<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suscriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->datetime('initdate');
            $table->datetime('enddate');
            $table->integer('user_id')->unsigned();// UNSIGNED que implica que no admita signos por lo que solo aceptaría enteros positivos.
            $table->integer('system_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('system_id')->references('id')->on('systems');
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
        Schema::dropIfExists('suscriptions');
    }
}
