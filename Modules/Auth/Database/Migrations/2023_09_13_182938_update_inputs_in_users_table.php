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
        Schema::table('users', function (Blueprint $table) {
            $table->string('facility_name')->nullable()->after('email');
            $table->string('city')->nullable()->after('email');
            $table->string('district')->nullable()->after('email');
            $table->string('street')->nullable()->after('email');
            $table->string('facility_number')->nullable()->after('email');
            $table->string('floor')->nullable()->after('email');
            $table->string('mobile')->nullable()->after('email');
            $table->string('code')->nullable()->after('facility_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('', function (Blueprint $table) {

        });
    }
};
