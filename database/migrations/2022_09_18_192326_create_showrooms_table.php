<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShowroomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('showrooms', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->default(null)->comment('Tên showroom');
            $table->string('address')->nullable()->default(null)->comment('Địa chỉ showroom');
            $table->string('phone')->nullable()->default(null);
            $table->longText('url')->nullable()->default(null);
            $table->bigInteger('district_id')->nullable()->default(0);
            $table->bigInteger('province_id')->nullable()->default(0);
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
        Schema::dropIfExists('showroom');
    }
}
