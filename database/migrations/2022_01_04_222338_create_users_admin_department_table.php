<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersAdminDepartmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_admin_department', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->default(0)->comment('Tên của khách hàng tại bảng users');
            $table->index('user_id');
            $table->bigInteger('admin_id')->default(0)->comment('Tên của trưởng phòng tại bảng admins');
            $table->index('admin_id');
            $table->bigInteger('department_id')->default(0)->comment('Phòng ban');
            $table->index('department_id');
            $table->tinyInteger('type')->default(0)->comment('1 = Người xử lý trưởng phòng,=2: Người xử lý chính,3 = Người xử lý phụ,4 = Người xử lý chuyên gia');
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
        Schema::dropIfExists('users_admin_department');
    }
}
