<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('title');
            $table->string('slug');
            $table->string('image');
            $table->longText('body');
            $table->integer('view_count')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('is_approved')->default(0);
            $table->date('date')->nullable();
            $table->timestamps();
            // $table->foreign('user_id')
            // ->references('id')->on('users')
            // ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
