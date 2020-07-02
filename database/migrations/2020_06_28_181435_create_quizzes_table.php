<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->enum('parent', ['materies', 'courses']);
            $table->unsignedBigInteger('parent_id');
            $table->enum('question_type', ['single_choice', 'multiple_choice', 'true_or_false', 'puzzle', 'essay'])->default('single_choice');
            $table->text('question')->nullable();
            $table->text('answer')->nullable();
            $table->char('correct_answer', 5)->nullable();
            $table->boolean('weekly_quiz')->default(0);
            $table->boolean('monthly_quiz')->default(0);
            $table->smallInteger('weight')->default(3);
            $table->smallInteger('duration')->default(20);
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
        Schema::dropIfExists('quizzes');
    }
}
