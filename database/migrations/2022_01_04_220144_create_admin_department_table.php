<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminDepartmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_department', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('admin_id')->nullable()->default(0);
            $table->bigInteger('department_id')->nullable()->default(0);
            $table->bigInteger('is_manager')->nullable()->default(0)->comment('=1: là trưởng phòng');
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
        Schema::dropIfExists('admin_department');
    }
}
