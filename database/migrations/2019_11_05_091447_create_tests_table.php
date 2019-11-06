<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('course_id');
            // $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->unsignedInteger('unit_id');
            // $table->foreign('unit_id')->references('id')->on('lessons')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->tinyInteger('published')->nullable()->default(0);
            
            $table->timestamps();
            $table->softDeletes();

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
        Schema::dropIfExists('tests');
    }
}
