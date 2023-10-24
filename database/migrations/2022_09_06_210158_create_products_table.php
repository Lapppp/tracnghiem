<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name',5000)->comment('Tên sản phẩm');
            $table->string('slug',5000)->comment('Tên sản phẩm dạng slug');
            $table->text('short_description')->nullable()->default(null)->comment('Nội dung ngắn sản phẩm');
            $table->text('description')->nullable()->default(null)->comment('Nội dung sản phẩm');
            $table->string('meta_title',5000)->comment('Dùng SEO tên sản phẩm');
            $table->text('meta_description')->comment('Dùng SEO nội dung sản phẩm');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->foreign('unit_id')->references('id')->on('units');
            $table->tinyInteger('status')->nullable()->default(0)->comment('=0:Deactivated,=1:active');
            $table->tinyInteger('options')->nullable()->default(0)->comment('=0:Sản phẩm mới,=1:Sản phẩm Hot,=2:Sản phẩm trang chủ');
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
        Schema::dropIfExists('products');
    }
}
