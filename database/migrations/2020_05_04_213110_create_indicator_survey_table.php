<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndicatorSurveyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indicator_survey', function (Blueprint $table) {
            $table->id();
            $table->double('min');
            $table->double('max');
            $table->double('step');
            $table->unsignedBigInteger('indicator_id');
            $table->foreign('indicator_id')
                ->references('id')
                ->on('indicators');
            $table->unsignedBigInteger('indicator_groups_id');
            $table->foreign('indicator_groups_id')
                ->references('id')
                ->on('indicator_groups');
            $table->unsignedBigInteger('survey_id');
            $table->foreign('survey_id')
                ->references('id')
                ->on('surveys');
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
        Schema::dropIfExists('indicator_survey');
    }
}
