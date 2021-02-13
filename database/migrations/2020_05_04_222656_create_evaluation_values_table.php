<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluationValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluation_values', function (Blueprint $table) {
            $table->id();
            $table->integer('value');
            $table->text('comment');
            $table->unsignedBigInteger('indicator_survey_id');
            $table->foreign('indicator_survey_id')
                ->references('id')
                ->on('indicator_survey');
            $table->unsignedBigInteger('establishment_evaluations_id');
            $table->foreign('establishment_evaluations_id')
                ->references('id')
                ->on('establishment_evaluations');
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
        Schema::dropIfExists('evaluation_values');
    }
}
