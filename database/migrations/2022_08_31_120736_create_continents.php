<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContinents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('continents', function (Blueprint $table) {
            $table->char('code', 2)->primary()->comment('Continent code');
            $table->string('name')->nullable();
        });

        /** Seed DB from DUMP */
        \Illuminate\Support\Facades\DB::unprepared("
            INSERT INTO `continents` VALUES ('AF', 'Africa');
            INSERT INTO `continents` VALUES ('AN', 'Antarctica');
            INSERT INTO `continents` VALUES ('AS', 'Asia');
            INSERT INTO `continents` VALUES ('EU', 'Europe');
            INSERT INTO `continents` VALUES ('NA', 'North America');
            INSERT INTO `continents` VALUES ('OC', 'Oceania');
            INSERT INTO `continents` VALUES ('SA', 'South America');
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('continents');
    }
}
