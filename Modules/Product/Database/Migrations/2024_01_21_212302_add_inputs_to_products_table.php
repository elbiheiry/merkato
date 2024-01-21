<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Type\Entities\Type;

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
            $table->dropConstrainedForeignIdFor(Type::class);
            $table->dropColumn('special_price');
            $table->text('description1');
            $table->float('maximum1');
            $table->float('price1');
            $table->float('discount1');
            $table->text('description2');
            $table->float('maximum2');
            $table->float('price2');
            $table->float('discount2');
            $table->float('convert1')->default(0);
            $table->float('convert2')->default(0);
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
