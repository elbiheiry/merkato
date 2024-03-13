<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->text('description')->nullable()->change();
            $table->text('description1')->nullable()->change();
            $table->text('description2')->nullable()->change();

            $table->float('maximum')->default(0)->change();
            $table->float('maximum1')->default(0)->change();
            $table->float('maximum2')->default(0)->change();

            $table->float('price')->default(0)->change();
            $table->float('price1')->default(0)->change();
            $table->float('price2')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
        });
    }
};
