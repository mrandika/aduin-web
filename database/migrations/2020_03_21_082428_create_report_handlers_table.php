<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportHandlersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_handlers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reports_id')->constrained()->onDelete('cascade');
            $table->foreignId('instance_handlers_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('instance_unit_handlers_id')->nullable()->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('report_handlers');
    }
}
