<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('m_data_instance_types_id')->constrained()->onDelete('cascade');
            $table->foreignId('m_data_instance_services_id')->constrained()->onDelete('cascade');
            $table->foreignId('m_zone_provinces_id')->constrained()->onDelete('cascade');
            $table->foreignId('m_zone_districts_id')->constrained()->onDelete('cascade');
            $table->foreignId('m_zone_subdistricts_id')->constrained()->onDelete('cascade');
            $table->foreignId('users_id')->constrained();
            $table->string('name');
            $table->text('address');
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
        Schema::dropIfExists('instances');
    }
}
