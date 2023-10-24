<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('support', function (Blueprint $table) {
            $table->id();
            $table->string('hotline')->nullable()->default(null)->comment('Hotline');
            $table->string('advise')->nullable()->default(null)->comment('Tư vấn');
            $table->string('insurance')->nullable()->default(null)->comment('Bảo hành');
            $table->string('email',50)->nullable()->default(null)->comment('Email');
            $table->string('product_consultation')->nullable()->default(null)->comment('TƯ VẤN SẢN PHẨM');
            $table->string('technical_assistance')->nullable()->default(null)->comment('HỖ TRỢ KỸ THUẬT');
            $table->string('free_call_center')->nullable()->default(null)->comment('TỔNG ĐÀI MIỄN PHÍ');
            $table->string('zalo')->nullable()->default(null)->comment('TƯ VẤN QUA ZALO');
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
        Schema::dropIfExists('support');
    }
}
