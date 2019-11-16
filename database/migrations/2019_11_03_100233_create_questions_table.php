<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            // $table->unsignedInteger('unit_id');
            $table->unsignedInteger('exam_id');
            $table->bigIncrements('question_id');
            $table->text('question');
            $table->integer('score')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->index(['deleted_at']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
