<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportBinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_bins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->constrained()->onDelete('cascade');
            $table->foreignId('instances_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('instance_units_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('content');
            $table->bigInteger('seen_count')->default(0);
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('report_bins');
    }
}
