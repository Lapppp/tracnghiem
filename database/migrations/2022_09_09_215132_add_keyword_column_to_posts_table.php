<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKeywordColumnToPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->text('meta_keywords')->nullable()->default(null)->comment('Thẻ meta keyword');
            $table->text('meta_description')->nullable()->default(null)->comment('Thẻ meta description');
            $table->text('meta_title')->nullable()->default(null)->comment('Thẻ meta title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            //
        });
    }
}
