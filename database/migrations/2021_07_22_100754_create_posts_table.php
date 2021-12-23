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
            $table->unsignedBigInteger('author_id')->index();
            $table->string('slug')->unique();
            $table->string('title', 255);
            $table->string('subtitle', 255)->nullabe();
            $table->string('tags')->nullable();
            $table->text('content');
            $table->text('image');
            $table->text('content_image')->nullable();
            $table->boolean('is_published')->default(false);
            $table->unsignedBigInteger('category_id')->index();
            $table->timestamps();

            $table->foreign('category_id')->references('id')
                                          ->on('categories');

            $table->foreign('author_id')->references('id')
                                     ->on('users');
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
