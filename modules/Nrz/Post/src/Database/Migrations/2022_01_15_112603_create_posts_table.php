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
            $table->string("title");
            $table->foreignId("user_id")->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId("media_id")->comment("image")
                ->nullable()->constrained()->nullOnDelete()->onUpdate("SET NULL");
            $table->text("description");
            $table->timestamps();
        });

        Schema::create('category_post', function (Blueprint $table) {
            $table->foreignId("category_id")->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId("post_id")->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->primary(['post_id', 'category_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_post');
        Schema::dropIfExists('posts');
    }
}
