<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('number');
            $table->enum('status', [
                'I',        //Incompleto
                'P',        //Pendente
                'A',        //Avalidado
                'S'         //Selecionado
            ]);
            $table->bigInteger('article_id');
            $table->foreign('article_id')->references('id')->on('articles');
            $table->bigInteger('edition_id');
            $table->foreign('edition_id')->references('id')->on('editions');
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
        Schema::dropIfExists('submissions');
    }
}
