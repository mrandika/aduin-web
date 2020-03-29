<?php

use App\Model\Master\Instance\InstanceUnit;
use App\Model\Master\Instance\InstanceUnitHandler;
use App\Model\Master\Zone\District;
use App\Model\Master\Zone\Province;
use App\Model\Master\Zone\Subdistrict;
use App\Model\Master\Report\Report;
use App\Model\Master\Report\ReportHandler;
use App\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class InstanceUnitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        $data = array();

        // Pemprov Unit
        for ($q = 1; $q <= 34; $q++) {
            $province = Province::find($q);
            $district = District::where('m_zone_provinces_id', $q)->first()->id;
            $subdistrict = Subdistrict::where(['m_zone_provinces_id' => $q, 'm_zone_districts_id' => $district])->first()->id;

            $admin = new User;
            $admin->username = $faker->userName;
            $admin->first_name = $faker->firstName;
            $admin->last_name = $faker->lastName;
            $admin->photo_url = url('assets/img/avatar/avatar-1.png');
            $admin->email = $faker->email;
            $admin->password = bcrypt('operatorunitinstansipemprov');
            $admin->role = '3';
            $admin->status = 1;
            $admin->save();

            $unit = new InstanceUnit;
            $unit->instances_id = $q;
            $unit->m_data_instance_types_id = 6;
            $unit->m_data_instance_services_id = 4;
            $unit->m_zone_provinces_id = $q;
            $unit->m_zone_districts_id = $district;
            $unit->m_zone_subdistricts_id = $subdistrict;
            $unit->users_id = $admin->id;
            $unit->name = "Dinas Pendidikan Provinsi $province->name";
            $unit->address = "Jl. $subdistrict No. $q";
            $unit->save();

            $user = new User;
            $user->username = $faker->userName;
            $user->first_name = $faker->firstName;
            $user->last_name = $faker->lastName;
            $user->photo_url = url('assets/img/avatar/avatar-3.png');
            $user->email = $faker->email;
            $user->password = bcrypt('masyarakatumum');
            $user->role = '1';
            $user->status = 1;
            $user->save();

            $report = new Report;
            $report->users_id = $user->id;
            $report->instances_id = $q;
            $report->title = "Laporan dari $user->username untuk unit instansi ID #$q";
            $report->content = "Lorem dorem ipsum dolor sit amet, consectetur adipisicing elit. Lorem dorem ipsum dolor sit amet, consectetur adipisicing elit. Lorem dorem ipsum dolor sit amet, consectetur adipisicing elit.";
            $report->seen_count = 0;
            $report->status = 1;
            $report->save();

            for ($i = 1; $i <= 2; $i++) { 
                $handler = new User;
                $handler->username = $faker->userName;
                $handler->first_name = $faker->firstName;
                $handler->last_name = $faker->lastName;
                $handler->photo_url = url('assets/img/avatar/avatar-2.png');
                $handler->email = $faker->email;
                $handler->password = bcrypt('petugasunitinstansipemprov');
                $handler->role = '2';
                $handler->status = 1;
                $handler->save();

                $instance_unit_handler = new InstanceUnitHandler;
                $instance_unit_handler->users_id = $handler->id;
                $instance_unit_handler->instance_units_id = $unit->id;
                $instance_unit_handler->save();

                $report_handler = new ReportHandler;
                $report_handler->reports_id = $report->id;
                $report_handler->instance_unit_handlers_id = $instance_unit_handler->id;
                $report_handler->save();
            }
        }
    }
}
