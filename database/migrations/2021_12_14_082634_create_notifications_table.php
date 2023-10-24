<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('post_id')->nullable()->default(0);
            $table->text('messages')->nullable()->default(null);
            $table->tinyInteger('status')->nullable()->default(0);
            $table->tinyInteger('is_read')->nullable()->default(0)->comment('=1:đã đọc,0: chưa đọc');
            $table->tinyInteger('type')->nullable()->default(0);
            $table->bigInteger('user_id')->nullable()->default(0);
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
        Schema::dropIfExists('notifications');
    }
}
