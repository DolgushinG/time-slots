<?php

use Illuminate\Database\Seeder;
use App\Service;
class ServiceTableSeeder extends Seeder
{
    public function run()
    {
        $service = [
            [
                'id'             => 1,
                'name_service'   => 'Снятие',
                'price'   =>    1300,
            ],
            [
                'id'             => 2,
                'name_service'   => 'Покрытие',
                'price'   =>    1500,
            ],
            [
                'id'             => 3,
                'name_service'   => 'Френч',
                'price'   =>    1700,
            ],
        ];

        Service::insert($service);
    }
}
