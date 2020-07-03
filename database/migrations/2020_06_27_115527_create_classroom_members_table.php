<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassroomMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classroom_members', function (Blueprint $table) {
            $table->unsignedBigInteger('classroom_id');
            $table->unsignedBigInteger('user_id');
            $table->tinyInteger('graduated')->default(0);
            $table->smallInteger('point')->default(0);
            $table->decimal('exp', 5, 2)->default(0);
            $table->timestamps();

            $table->foreign('classroom_id')->references('id')->on('classrooms')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classroom_members');
    }
}
