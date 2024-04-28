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
        Schema::dropIfExists('tweets');
        Schema::create('tweets', function (Blueprint $table) {
            $table->integer('_id')->unsigned()->autoIncrement();
            $table->unsignedInteger('user_id');
            $table->text('tweet')->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->integer('likes_count')->default(0);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            // Foreign key constraint
            $table->foreign('user_id')->references('_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tweets');
    }
};
