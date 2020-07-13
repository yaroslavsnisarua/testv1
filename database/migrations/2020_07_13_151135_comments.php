<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Comments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        


/*

-id (INTEGER)
-post_id (INTEGER) (FK posts.id)
-commentator_id (INTEGER) (FK users.id)
-content (TEXT)
-created_at (TIMESTAMP)
-updated_at (TIMESTAMP)
-deleted_at (TIMESTAMP) (NULLABLE)

*/

Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->integer('post_id')->unsigned();
            $table->integer('commentator_id')->unsigned();
            $table->text('content');
            $table->timestamps();
            $table->softDeletes();
        });
Schema::table('comments', function($table) {
            $table->foreign('post_id')->references('id')->on('posts');
            $table->foreign('commentator_id')->references('id')->on('users');
   });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
