<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_profiles', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->unique();
            $table->enum('id_type', ['ktp', 'sim', 'passport', 'kp', 'km'])->nullable();
            $table->char('id_number', 18)->nullable();
            $table->char('member_id', 10)->nullable();
            $table->string('name')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->date('birthday')->nullable();
            $table->char('address_code', 12)->nullable();
            $table->char('whatsapp', 16)->nullable();
            $table->text('adress')->nullable();

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
        Schema::dropIfExists('member_profiles');
    }
}
