<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberMateriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_materies', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('matery_id');
            
            $table->dateTime('quiz_enabled')->nullable();
            $table->dateTime('quiz_started')->nullable();
            $table->tinyInteger('quiz_paused')->nullable();
            $table->tinyInteger('quiz_ended')->nullable();

            $table->text('quiz_questions', 100)->nullable();
            $table->text('quiz_answers', 100)->nullable();
            $table->text('quiz_corrections', 100)->nullable();

            $table->decimal('quiz_score', 5, 2)->nullable();
            $table->smallInteger('reading_times')->default(0);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('matery_id')->references('id')->on('materies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('member_materies');
    }
}
