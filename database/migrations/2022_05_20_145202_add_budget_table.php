<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBudgetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budgets', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->float("price");
            $table->integer("quantity");
            $table->unsignedBigInteger('animation_id');
            $table->foreign('animation_id')->references('id')->on('animations');
            $table->timestamps();
        });

        Schema::create('global_budgets', function (Blueprint $table) {
            $table->id();
            $table->float("budget");
            $table->unsignedBigInteger('animation_id');
            $table->foreign('animation_id')->references('id')->on('animations');
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
        Schema::dropIfExists('budgets');
        Schema::dropIfExists('global_budgets');
    }
}
