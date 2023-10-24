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
            $table->tinyInteger('status')->default(0)->comment('=0:Deactivated,=1:Active');
            $table->tinyInteger('options')->default(0)->comment('=0:New,=1:Hot,=2:Home');
            $table->index('options');
            $table->bigInteger('category_id')->default(0);
            $table->index('category_id');
            $table->bigInteger('module_id')->default(0);
            $table->index('module_id');
            $table->integer('views')->default(0)->comment('number of views');
            $table->timestamps();
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
