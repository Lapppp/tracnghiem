<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Tên thương hiệu duy nhất');
            $table->string('brand_slug')->comment('Tên thương hiệu duy nhất dạng slug');
            $table->unique('name');
            $table->unique('brand_slug');
            $table->tinyInteger('status')->nullable()->default(0)->comment('1:active,0:deactivated');
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
        Schema::dropIfExists('brands');
    }
}
