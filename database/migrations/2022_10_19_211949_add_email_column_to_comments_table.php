<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmailColumnToCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->string('email',100)->nullable()->default(null);
            $table->string('phone',50)->nullable()->default(null);
            $table->string('name')->nullable()->default(null);
            $table->tinyInteger('status')->nullable()->default(0);
            $table->tinyInteger('number_star')->nullable()->default(0)->comment('Số sao mà khách hàng đánh giá');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            //
        });
    }
}
