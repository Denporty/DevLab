<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAnimationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('localisation');
            $table->timestamp('tag')->nullable();
            $table->string('department')->nullable();
            $table->string('places');
            $table->string('description');
            $table->string('start_date');
            $table->string('end_date');
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
        Schema::dropIfExists('animations');
    }
}
