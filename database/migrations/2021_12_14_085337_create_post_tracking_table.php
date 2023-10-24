<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTrackingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_tracking', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('post_id')->nullable()->default(0);
            $table->tinyInteger('old_status_id')->nullable()->default(0);
            $table->string('old_status')->nullable()->default(null);
            $table->tinyInteger('status_id')->nullable()->default(0);
            $table->string('status')->nullable()->default(null);
            $table->dateTime('deadline')->nullable()->default(null);
            $table->text('messages')->nullable()->default(null);
            $table->text('created_by')->nullable()->default(null)->comment('Trả về json');
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
        Schema::dropIfExists('post_tracking');
    }
}
