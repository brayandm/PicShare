<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person_person', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('follower_id');
            $table->foreign('follower_id')->references('id')->on('people')->onDelete('cascade');
            $table->unsignedBigInteger('following_id');
            $table->foreign('following_id')->references('id')->on('people')->onDelete('cascade');
            $table->timestamps();

            $table->index('follower_id');
            $table->index('following_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('person_person');
    }
};
