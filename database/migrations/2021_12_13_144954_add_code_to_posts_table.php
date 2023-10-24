<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCodeToPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('code')->nullable()->default(null)->comment('Mã hồ sơ');
            $table->string('code_number')->nullable()->default(null)->comment('Số hồ sơ');
            $table->dateTime('date_of_filing')->nullable()->default(null)->comment('Ngày nộp đơn');
            $table->dateTime('received_date')->nullable()->default(null)->comment('Ngày nhận đơn');
            $table->dateTime('deadline')->nullable()->default(null)->comment('thời hạn của hồ sơ');
            $table->bigInteger('user_id')->nullable()->default(0)->comment('Người tạo hồ sơ');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('code');
            $table->dropColumn('code_number');
            $table->dropColumn('date_of_filing');
            $table->dropColumn('received_date');
            $table->dropColumn('user_id');
            $table->dropColumn('deadline');
        });
    }
}
