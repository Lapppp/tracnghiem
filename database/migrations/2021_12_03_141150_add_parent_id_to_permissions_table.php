<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddParentIdToPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('permissions', function (Blueprint $table) {
            $table->bigInteger('parent_id')->default(0);
            $table->string('route')->nullable()->default(null);
            $table->integer('weight')->default(0);
            $table->string('customize_name')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('permissions', function (Blueprint $table) {
            $table->dropColumn('parent_id');
            $table->dropColumn('route');
            $table->dropColumn('weight');
            $table->dropColumn('customize_name');
        });
    }
}
