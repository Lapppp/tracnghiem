<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStartTimeToTestUsersTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('test_users_tests', function (Blueprint $table) {

            if (!Schema::hasColumn('test_users_tests', 'start_time')) {
                $table->dateTime('start_time')->nullable()->default(null)->comment('Thời gian bắt đầu bài thi');
            }

            if (!Schema::hasColumn('test_users_tests', 'end_time')) {
                $table->dateTime('end_time')->nullable()->default(null)->comment('Thời gian kết thúc bài thi');
            }


            if (!Schema::hasColumn('test_users_tests', 'stop_time')) {
                $table->dateTime('stop_time')->nullable()->default(null)->comment('Thời gian dừng bài thi');
            }

            if (!Schema::hasColumn('test_users_tests', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable()->default(0);
            }


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('test_users_tests', function (Blueprint $table) {
            //
        });
    }
}
