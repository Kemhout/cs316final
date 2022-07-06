<?php


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->text('code_name');
            $table->text('type_of_course');
            $table->string('department')->nullable();
            $table->string('require');
            $table->integer('semester');
            $table->integer('credit');
            $table->string('studyOrNot')->nullable();
            $table->integer('grade')->nullable();
            $table->string('professor');
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
        Schema::dropIfExists('courses');
    }
}