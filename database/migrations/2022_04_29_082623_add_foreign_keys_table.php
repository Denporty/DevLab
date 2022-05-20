<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('department')->change();
            $table->foreign('department')->references('id')->on('departments');
        });

        Schema::table('animations', function (Blueprint $table) {
            $table->unsignedBigInteger('department')->change();
            $table->foreign('department')->references('id')->on('departments');
            $table->unsignedBigInteger('tag')->change();
            $table->foreign('tag')->references('id')->on('departments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('department');
            $table->string('department')->change();
        });

        Schema::table('animations', function (Blueprint $table) {
            $table->dropForeign('department');
            $table->string('department')->change();
            $table->dropForeign('tag');
            $table->string('tag')->change();
        });
    }
}
