<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test', function (Blueprint $table) {
            $table->id();
            $table->string('title', 2000)->nullable()->default(null);
            $table->text('description')->nullable()->default(null);
            $table->unsignedBigInteger('category_id')->nullable()->default(0);
            $table->unsignedBigInteger('subject_id')->nullable()->default(0);
            $table->tinyInteger('status')->nullable()->default(1)->comment('=0:deactivated,=1:active');
            $table->integer('score_time')->nullable()->default(0);
            $table->date('start_date')->nullable()->default(null);
            $table->date('end_date')->nullable()->default(null);
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
        Schema::dropIfExists('test');
    }
}
