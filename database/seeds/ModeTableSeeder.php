<?php

use Illuminate\Database\Seeder;
use App\ModeOfSchedule;
class ModeTableSeeder extends Seeder
{
    public function run()
    {
        $mode = [
            [
                'id'             => 1,
                'two_in_two'   => false,
                'latest_work_day'   => '',
            ],
        ];

        ModeOfSchedule::insert($mode);
    }
}
