<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('name',2000)->nullable()->default(null)->comment('Tên câu hỏi');
            $table->text('answer')->nullable()->default(null)->comment('Câu trả lời');
            $table->tinyInteger('status')->nullable()->default(0)->comment('=1:hiện thị câu hỏi, =0:ẩn câu hỏi');
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
        Schema::dropIfExists('questions');
    }
}
