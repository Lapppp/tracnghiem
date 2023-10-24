<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWarrantyColumnToOrdersDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders_detail', function (Blueprint $table) {
            $table->string('warranty')->nullable()->default(null)->comment('Bảo hành');
            $table->string('maintenance')->nullable()->default(null)->comment('Bảo trì');
            $table->bigInteger('quantity_in_stock')->nullable()->default(0)->comment('Số lượng tồn');
            $table->tinyInteger('status_in_stock')->nullable()->default(null)->comment('tình trạng hàng');
            $table->tinyInteger('color')->nullable()->default(0)->comment('Màu sắc của sản phẩm');
            $table->tinyInteger('delivery_time')->nullable()->default(0)->comment('4:giờ,8:giờ,12:giờ,48 giờ');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders_detail', function (Blueprint $table) {
            //
        });
    }
}
