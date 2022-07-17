<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudyPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('study_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('studys_plan_group');
            $table->integer('majors_id')->unsigned()->nullable();
            $table->integer('courses_id')->unsigned()->nullable();
            $table->integer('semester')->nullable();
            $table->string('department')->nullable();
            //$table->string('study_plan_name');
            $table->string('name');
            $table->integer('academic_year')->nullable();
            $table->string('year_level')->nullable();
            $table->foreign('majors_id')->references('id')->on('majors')->onDelete('cascade');
            $table->foreign('courses_id')->references('id')->on('courses')->onDelete('cascade');
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
        Schema::dropIfExists('study_plans');
    }
}
