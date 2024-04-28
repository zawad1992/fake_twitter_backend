<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('followers');
        Schema::create('followers', function (Blueprint $table) {
            $table->integer('_id')->unsigned()->autoIncrement();
            $table->unsignedInteger('follower_id')->nullable();
            $table->unsignedInteger('followed_id')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            // Foreign key constraints
            $table->foreign('follower_id')->references('_id')->on('users')->onDelete('cascade');
            $table->foreign('followed_id')->references('_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('followers');
    }
}
