<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('total')->nullable()->default(0)->comment('Tồng tiền giá trị đơn hàng');
            $table->string('coupon_code')->nullable()->default(null)->comment('Mã coupon');
            $table->bigInteger('coupon_amount')->nullable()->default(0)->comment('Tiền mã giảm giá');
            $table->bigInteger('order_price')->nullable()->default(0)->comment('Tồng tiền chưa giảm');
            $table->bigInteger('user_id')->nullable()->default(0)->comment('Mã khách hàng');
            $table->string('full_name')->nullable()->default(null)->comment('Tên khách hàng nhận');
            $table->string('address')->nullable()->default(null)->comment('Địa chỉ nhận hàng');
            $table->string('phone')->nullable()->default(null)->comment('Điện thoại khách hàng');
            $table->text('order_notes')->nullable()->default(null)->comment('Điện thoại khách hàng');
            $table->index('user_id');


            $table->bigInteger('province_id')->nullable()->default(0);
            $table->bigInteger('district_id')->nullable()->default(0);
            $table->bigInteger('hamlet_id')->nullable()->default(0);


            $table->tinyInteger('status')->nullable()->default(1)->comment('Trạng thái đơn hàng');
            $table->index('status');
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
        Schema::dropIfExists('orders');
    }
}
