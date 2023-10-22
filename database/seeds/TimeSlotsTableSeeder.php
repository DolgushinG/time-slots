<?php

use Illuminate\Database\Seeder;
use App\TimeSlot;
class TimeSlotsTableSeeder extends Seeder
{
    public function run()
    {
        $time_slots = [];
        $count = 1;
        while ($count <= 16) {

            if ($count<=9){
                $zero = '0';
            } else {
                $zero = '';
            }
            $time_slots[] = [
                'id'             => $count,
                'time_slot'   => $zero.(6+$count).':00:00',
                'is_open'   => false,
                'monday'   => false,
                'tuesday'   => false,
                'wednesday'   => false,
                'thursday'   => false,
                'friday'   => false,
                'saturday'   => false,
                'sunday'   => false,
            ];
            $count+=1;
        }

        TimeSlot::insert($time_slots);
    }
}
