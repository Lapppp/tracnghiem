<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsMultipleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions_multiple', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('post_id');
            $table->string('a', 5000)->nullable()->default(null);
            $table->string('b', 5000)->nullable()->default(null);
            $table->string('c', 5000)->nullable()->default(null);
            $table->string('d', 5000)->nullable()->default(null);
            $table->string('e', 5000)->nullable()->default(null);
            $table->string('is_correct')->nullable()->default(5);
            $table->string('group_question', 50);
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
        Schema::dropIfExists('questions_multiple');
    }
}
