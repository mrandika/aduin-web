<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Model\Master\Instance\InstanceService;

class CreateInstanceServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_data_instance_services', function (Blueprint $table) {
            $table->id();
            $table->string('index');
            $table->string('name');
        });

        $data = [
            ['index' => 'ISID', 'name' => 'Instansi Induk'],
            ['index' => 'KSHT', 'name' => 'Kesehatan'],
            ['index' => 'KTNG', 'name' => 'Ketenagakerjaan'],
            ['index' => 'PNDK', 'name' => 'Pendidikan'],
            ['index' => 'KMIF', 'name' => 'Komunikasi dan Informasi'],
        ];

        InstanceService::insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instance_services');
    }
}
