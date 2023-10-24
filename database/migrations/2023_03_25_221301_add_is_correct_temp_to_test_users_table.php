<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsCorrectTempToTestUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('test_users', function (Blueprint $table) {
            if (!Schema::hasColumn('test_users', 'is_correct_temp')) {
                $table->tinyInteger('is_correct_temp')->nullable()->default(1);
            }

            if (!Schema::hasColumn('test_users', 'test_id_test')) {
                $table->unsignedBigInteger('test_id_test')->nullable()->default(0)->comment('Tham chiếu từ bảng test_users_tests');
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
        Schema::table('test_users', function (Blueprint $table) {
            //
        });
    }
}
