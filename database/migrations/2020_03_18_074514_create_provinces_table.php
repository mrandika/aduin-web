<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvincesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_zone_provinces', function (Blueprint $table) {
            $table->id();
            $table->string('index');
            $table->string('name');
        });

        DB::unprepared(file_get_contents("database/seeds/file/m_zone_provinces.sql"));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_zone_provinces');
    }
}
