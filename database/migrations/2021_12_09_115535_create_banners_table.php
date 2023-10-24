<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->default(null);
            $table->text('description')->nullable()->default(null);
            $table->longText('url')->nullable()->default(null);
            $table->tinyInteger('position')->nullable()->default(1)->comment('=1 trang chủ');
            $table->tinyInteger('type')->nullable()->default(1)->comment('=1:kiểu hình ảnh');
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
        Schema::dropIfExists('banners');
    }
}
