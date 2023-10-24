<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name',2000)->nullable()->default(null)->comment('Tên công ty');
            $table->string('certificate',2000)->nullable()->default(null)->comment('Giấy chứng nhận');
            $table->string('granted_by',2000)->nullable()->default(null)->comment('Cấp bởi');
            $table->text('address')->nullable()->default(null)->comment('Địa chỉ');
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
        Schema::dropIfExists('companies');
    }
}
