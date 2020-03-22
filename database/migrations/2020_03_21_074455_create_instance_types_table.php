<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Model\Master\Instance\InstanceType;

class CreateInstanceTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_data_instance_types', function (Blueprint $table) {
            $table->id();
            $table->string('index');
            $table->string('name');
        });

        $data = [
            ['index' => 'KEM', 'name' => 'Kementrian'],
            ['index' => 'LBG', 'name' => 'Lembaga'],
            ['index' => 'PMKB', 'name' => 'Pemerintah Kabupaten'],
            ['index' => 'PMKT', 'name' => 'Pemerintah Kota'],
            ['index' => 'PMPR', 'name' => 'Pemerintah Provinsi'],
            ['index' => 'OGPD', 'name' => 'Organisasi Perangkat Daerah'],
        ];

        InstanceType::insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instance_types');
    }
}
