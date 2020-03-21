<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubdistrictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_zone_subdistricts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('m_zone_provinces_id')->onDelete('cascade');
            $table->foreignId('m_zone_districts_id')->onDelete('cascade');
            $table->string('index');
            $table->string('name');
        });

        DB::unprepared(file_get_contents("database/seeds/file/m_zone_subdistricts.sql"));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_zone_subdistricts');
    }
}
