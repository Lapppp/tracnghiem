<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advises', function (Blueprint $table) {
            $table->id();
            $table->string('full_name')->nullable()->default(null)->comment('Họ tên người yêu cầu');
            $table->string('phone',20)->nullable()->default(null)->comment('Điện thoại người yêu cầu');
            $table->text('description')->nullable()->default(null)->comment('Nội dụng thắc mắc, yêu cầu');
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
        Schema::dropIfExists('advise');
    }
}
