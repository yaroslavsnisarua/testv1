<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Posts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


/*-author_id  (INTEGER) (FK users.id)
-image_id (INTEGER) (NULLABLE) (FK images.id)
-content (TEXT)
-created_at (TIMESTAMP)
-updated_at (TIMESTAMP)
-deleted_at (TIMESTAMP) (NULLABLE)*/


        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->integer('author_id')->unsigned();
            $table->integer('image_id')->unsigned()->nullable();
            $table->text('content');
            $table->timestamps();
            $table->softDeletes();
        });




Schema::table('posts', function($table) {
       $table->foreign('author_id')->references('id')->on('users');
       $table->foreign('image_id')->references('id')->on('images')->nullable();
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
