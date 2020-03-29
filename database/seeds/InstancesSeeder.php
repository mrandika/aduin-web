<?php

use App\Model\Master\Instance\Instance;
use App\Model\Master\Instance\InstanceHandler;
use App\Model\Master\Zone\District;
use App\Model\Master\Zone\Province;
use App\Model\Master\Zone\Subdistrict;
use App\Model\Master\Report\Report;
use App\Model\Master\Report\ReportHandler;
use App\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class InstancesSeeder extends Seeder
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

        // Pemprov
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
            $admin->password = bcrypt('operatorinstansipemprov');
            $admin->role = '3';
            $admin->status = 1;
            $admin->save();

            $instance = new Instance;
            $instance->m_data_instance_types_id = 5;
            $instance->m_data_instance_services_id = 1;
            $instance->m_zone_provinces_id = $q;
            $instance->m_zone_districts_id = $district;
            $instance->m_zone_subdistricts_id = $subdistrict;
            $instance->users_id = $admin->id;
            $instance->name = "Pemerintah Provinsi $province->name";
            $instance->address = "Jl. $subdistrict No. $q";
            $instance->save();

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
            $report->title = "Laporan dari $user->username untuk instansi ID #$q";
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
                $handler->password = bcrypt('petugasinstansipemprov');
                $handler->role = '2';
                $handler->status = 1;
                $handler->save();

                $instance_handler = new InstanceHandler;
                $instance_handler->users_id = $handler->id;
                $instance_handler->instances_id = $instance->id;
                $instance_handler->save();

                $report_handler = new ReportHandler;
                $report_handler->reports_id = $report->id;
                $report_handler->instance_handlers_id = $instance_handler->id;
                $report_handler->save();
            }
        }
    }
}
