<?php

namespace App\Http\Controllers;
use App\EventAndTimeSlot;
use App\ModeOfSchedule;
use App\Service;
use App\TimeSlot;
use DateTime;
use Illuminate\Http\Request;
use App\Event;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use stdClass;
use App\Helpers\Utils\Telegram;

class BookingController extends Controller
{

    public function daten(){
        return '2023-10-29';
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $date = new DateTime();
        $date_now_format = $date->format('Y-m-d');
        $count = 1;
        while($count < 10) {
            $mode = ModeOfSchedule::all()->first();
            $new_latest = date("Y-m-d", strtotime('+4 day', strtotime($mode->latest_work_day)));
            $count+=1;
            $earlier = new DateTime($new_latest);
            $later = new DateTime($date_now_format);
            $neg_diff = $earlier->diff($later)->format("%r%a"); //-3
            if(intval($neg_diff) < 0){
                break;
            } else {
                $new_mode = ModeOfSchedule::find($mode->id)->first();
                $new_mode->latest_work_day = $new_latest;
                $new_mode->save();
            }

        }
        $mode = ModeOfSchedule::all()->first();
        $show_next_month = false;
        $remaining_days = $this->listRemainingDays($date_now_format, $next_month=false);
        $timestamp = strtotime($date_now_format);
        $daysRemaining = (int)date('t', $timestamp) - (int)date('j', $timestamp);
        if($mode->two_in_two) {
            $count = $daysRemaining / 2;
        } else {
            $count = $daysRemaining;
        }
//        dd($daysRemaining);
        if (intval($count) < 7) {
            $show_next_month = true;
        }
        $next_month_format = date("Y-m-d", strtotime('+1 month', strtotime($date_now_format)));
        $remaining_days_next_month = $this->listRemainingDays($next_month_format, $next_month=true);
        $current_month = new stdClass();
        $next_month = new stdClass();
        $months = [];
        if ($remaining_days){
            $current_month->format = $date_now_format;
            $current_month->name = "current_month";
            $current_month->ru_month = $this->onStart($date_now_format);
            $current_month->remaining_days = $remaining_days;
            $months[] = $current_month;
        }
        if($show_next_month) {
            $next_month->format = $next_month_format;
            $next_month->name = "next_month";
            $next_month->ru_month = $this->onStart($next_month_format);
            $next_month->remaining_days = $remaining_days_next_month;
            $months[] = $next_month;
        }
        $google_iframe = $this->google_maps_iframe();
        $services = Service::all();
        return view('new_booking', compact('services', 'months', 'google_iframe'));
    }
    public function get_name_day_of_week($date){
       return strftime("%A",strtotime($date));
    }

    public function getDays(Request $request){
        $limit_days = 14;
        $date = new DateTime();
        $date_now_format = $date->format('Y-m-d');
        if ($request->date !== $date_now_format){
            $count_days = $this->listRemainingDays($date_now_format, $next_month=true);
        } else {
            $count_days = $this->listRemainingDays($date_now_format, $next_month=false);
        }
        $mode = ModeOfSchedule::all()->first();
//        dd($mode->two_in_two,$request->date,$date_now_format);
        if ($mode->two_in_two && $request->date === $date_now_format){
            $timestamp = strtotime($mode->latest_work_day);
            $date = new DateTime($mode->latest_work_day);
            $latest_work_day_format = $date->format('Y-m-d');
            $daysRemaining = (int)date('t', $timestamp);
            $remaining_days = $this->filter_mode($daysRemaining, $latest_work_day_format);
        }
        if(!$mode->two_in_two) {
            $remaining_days = $count_days;
        }
        if ($mode->two_in_two && $request->date !== $date_now_format){
            $timestamp = strtotime($mode->latest_work_day);
            $date = new DateTime($mode->latest_work_day);
            $latest_work_day_format = $date->format('Y-m-d');
            $daysRemaining = (int)date('t', $timestamp);

            $remaining_days = $this->filter_mode($daysRemaining, $latest_work_day_format);
//            dd($remaining_days);
            $next_day_with_count= date("Y-m-d", strtotime('+3 day', strtotime($remaining_days[count($remaining_days)-1]->format)));
//            dd($next_day_with_count);
            $remaining_days = $this->filter_mode($daysRemaining, $next_day_with_count, $with_day_off=true);
            $timestamp = strtotime($date_now_format);
            $daysRemaining = (int)date('t', $timestamp)- (int)date('j', $timestamp);
//            dd($next_day_with_count);
            $remaining_days = array_slice($remaining_days, 0, $limit_days - $daysRemaining);

        }
        return view('days', compact('remaining_days'));
    }
    public function filter_mode($count_days, $latest_work_day, $with_day_off=false){

        $timestamp = strtotime($latest_work_day);
        list($year, $month, $day) = explode('-', date("Y-m-d", $timestamp));
//        dd($day);
        $between_day = 0;
        $start = $with_day_off ? $day :intval($day) + 3;
//        dd($start);
        $remaining_days_full = [];
        for($i = $start; $i < 16 + $start; $i+=1){
            for($x = 0; $x < 2; $x+=1){

                if ($x + $i + $between_day >= $count_days + 1){
//                    dd($x == 0 && $x + $i + $between_day == 31 || $x + $i + $between_day == 30 );
                    if ($x == 1 && $with_day_off) {
                        $days = new stdClass();
                        $next_day_next_month= date("Y-m-d", strtotime('+1 month', strtotime($year.'-'.$month.'-'.'1')));
                        $days->day = date("d", strtotime($next_day_next_month));
                        $days->format = date("Y-m-d", strtotime($next_day_next_month));
                        $days->day_of_week = $this->get_name_day_of_week(date("Y-m-d", strtotime($next_day_next_month)));
                        array_unshift($remaining_days_full, $days);

                    }
                        break;
                }
//                dd($x, $i, $between_day);
                $work_day_format = $year.'-'.$month.'-'.($x + $i + $between_day);
                $days = new stdClass();
                $days->day = date("d", strtotime($work_day_format));
                $days->format = date("Y-m-d", strtotime($work_day_format));
                $days->day_of_week = $this->get_name_day_of_week(date("Y-m-d", strtotime($work_day_format)));
                $remaining_days_full[] = $days;
//                dd($remaining_days_full);
            }
            $between_day += 3;
        }
        return $remaining_days_full;
    }
    public function getTimeSlots(Request $request){

        $events = Event::where('date', '=' ,$request->date)->pluck('id');
        $name_day_of_week = $this->get_name_day_of_week($request->date);
//        dd($events);
        if (count($events) > 0){
            $events_and_time_slots = EventAndTimeSlot::whereIn('event_id', $events)->pluck('time_slot_id');
//            dd($request->date);
            $free_time_slots = TimeSlot::whereNotIn('id', $events_and_time_slots)->get();
//            dd($free_time_slots);
            $free_time_slots->toArray();
//            dd($free_time_slots, 1);
            $free_time_slots = $this->filter_time_slots($free_time_slots, $name_day_of_week);
//            dd($a);
        } else {
            $day_of_week = $this->get_name_day_of_week($request->date);
//            $free_time_slots = TimeSlot::where('is_open','=', 1)->get();
//
            $free_time_slots = TimeSlot::orWhere([
                [$day_of_week, '=', '1'],

            ])->orWhere([['is_open', '=', '1']])->get();
//            $free_time_slots->toArray();
//            dd($free_time_slots);
//            $free_time_slots = TimeSlot::where($day_of_week, '=', 1)->get();
//            $free_time_slots = TimeSlot::where('is_open','=', 1)
//            $free_time_slots = TimeSlot::where('is_open','=', 1)
//                ->get();
        }
//        dd($free_time_slots);
        $date_format = $request->date;
        return view('time_slots', compact('free_time_slots', 'date_format'));
    }

    public function filter_time_slots($time_slots, $name_day_of_week){

        $free_time_slots = [];
//        dd($name_day_of_week);
        foreach ($time_slots as $time_slot) {
//            dd($time_slot->is_open);
            if ($time_slot->is_open) {
                $free_time_slots[] = $time_slot;
            } else {
                $method = strtolower($name_day_of_week);
                if($time_slot->$method) {
                    $free_time_slots[] = $time_slot;
                }
            }

        }
        return $free_time_slots;

    }
    public function listRemainingDays($date, $next_month){
        $timestamp = strtotime($date);
        $remaining_days_full = [];
        list($year, $month, $day) = explode('-', date("Y-m-d", $timestamp));
        $count = $next_month ? 0 : 1;
        $daysRemaining = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        while($count <= $daysRemaining){
            $days = new stdClass();
            $days->day = date("d", strtotime('+'.$count.' day', strtotime($date)));
            $days->format = date("Y-m-d", strtotime('+'.$count.' day', strtotime($date)));
            $days->day_of_week = $this->get_name_day_of_week(date("Y-m-d", strtotime('+'.$count.' day', strtotime($date))));
            $remaining_days_full[] = $days;

            $count += 1;
        }
        return array_slice($remaining_days_full, 0, 14);
    }

    public function onStart($date): string
    {
        $explode_data=explode("-", $date);
        switch ($explode_data[1]){
            case 1: $m='Январь'; break;
            case 2: $m='Февраль'; break;
            case 3: $m='Март'; break;
            case 4: $m='Апрель'; break;
            case 5: $m='Май'; break;
            case 6: $m='Июнь'; break;
            case 7: $m='Июль'; break;
            case 8: $m='Август'; break;
            case 9: $m='Сентябрь'; break;
            case 10: $m='Октябрь'; break;
            case 11: $m='Ноябрь'; break;
            case 12: $m='Декабрь'; break;
        }
        return $m;
    }
    public function bookingAfter(Event $event){
        $booking = new stdClass();
        $service = Service::where('id', '=', $event->name_service)->first();
        $digits = 5;
        $date = new DateTime($event->start_time);
        $telegram_start_time = $date->format('d-m-Y H:i:s');
        $booking->start_time = $telegram_start_time;
        $booking->id = $event->id.'-'.rand(pow(10, $digits-1), pow(10, $digits)-1);;
        $booking->name = $event->name;
        $booking->phone = $event->phone;

        return view('booking_after', compact('booking', 'service'));
    }
    public function booked(Request $request){

        $messages = array(
            'name.required' => 'Имя и Фамалия обязательно к заполнению',
            'service_id.required' => 'Услуга обязательно к заполнению',
            'phone.required' => 'Телефон обязателен к заполнению',
            'month.required' => 'Месяц обязательно к заполнению',
            'day.required' => 'День обязательно к заполнению',
            'time_slot.required' => 'Время обязательно к заполнению',
        );
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'phone' => 'required',
            'service_id' => 'required',
            'month' => 'required',
            'day' => 'required',
            'time_slot' => 'required',
        ],$messages);
        if ($validator->fails())
        {
            return response()->json(['error' => true,'message'=>$validator->errors()->all()],422);
        }
        $exist_book = $this->check_exist_book($request->day, intval($request->time_slot));
        if ($exist_book) {
            return response()->json(['error' => true,'message'=> 'Ошибка сохранения'],422);
        }
        $time_slot = TimeSlot::where('id', intval($request->time_slot))->first()->time_slot;
        $date = new DateTime($request->day.' '.$time_slot);
        $start_time = $date->format('Y-m-d H:i:s');
        $telegram_start_time = $date->format('d-m-Y H:i:s');
        $date_start_time = $date->format('Y-m-d');
        $end_time = date("Y-m-d H:i:s", strtotime('+2 hours', strtotime($start_time)));
        $event = new Event();
        $service = Service::where('id', '=', $request->service_id)->first();
        $msg = new stdClass();
        $msg->name = $request->name;
        $msg->start_time = $telegram_start_time;
        $msg->phone = $request->phone;
        $msg->name_service = $service->name_service;
        $vowels = array("+", "(", ")", "-", " ");
        $format_phone = str_replace($vowels, "", $request->phone);
        $event->name = $request->name;
        $event->start_time = $start_time;
        $event->phone = $format_phone;
        $event->date = $date_start_time;
        $event->end_time = $end_time;
        $event->name_service = $request->service_id;
        $event->save();
        $eat = new EventAndTimeSlot();
        $eat->event_id = $event->id;
        $eat->time_slot_id = $request->time_slot;
        $eat->save();
        // $details = [
        //     'title' => $request->subject,
        //     'body' => $request->event_description,
        //     'userName' => $request->event_start_date,
        //     'userCity' => $request->event_city
        // ];
        // Mail::to('Dolgushing@yandex.ru')->send(new NewUser($details));
        $telegram = new Telegram();
        $telegram->send_telegram($msg);
         if ($event->save()) {
             return response()->json(['success' => true, 'message' => 'Успешно забронировано', 'id' => $event->id], 201);
         } else {
             return response()->json(['success' => false, 'message' => 'ошибка сохранения'], 422);
         }
    }

    public function google_maps_iframe(){
        $zoom = 5000;
        $address = 'Ulitsa Sedova, 126, St Petersburg, 192174';
        $lng = 'ru';

        $src = 'https://www.google.com/maps/embed?pb='.
            '!1m18'.
            '!1m12'.
            '!1m3'.
            '!1d'.$zoom.
            '!2d0'.
            '!3d0'.
            '!2m3'.
            '!1f0'.
            '!2f0'.
            '!3f0'.
            '!3m2'.
            '!1i1024'.
            '!2i768'.
            '!4f13.1'.
            '!3m3'.
            '!1m2'.
            '!1s0'.
            '!2s'.rawurlencode($address).
            '!5e0'.
            '!3m2'.
            '!1s'.$lng.
            '!2s'.$lng.
            '!4v'.time().'000'.
            '!5m2'.
            '!1s'.$lng.
            '!2s'.$lng;

        return $src;
    }

    public function bookingEdit(Event $event){
        $booking = new stdClass();
        $service = Service::where('id', '=', $event->name_service)->first();
        $digits = 5;
        $date = new DateTime($event->start_time);
        $telegram_start_time = $date->format('d-m-Y H:i:s');
        $booking->start_time = $telegram_start_time;
        $booking->id = $event->id.'-'.rand(pow(10, $digits-1), pow(10, $digits)-1);;
        $booking->name = $event->name;
        $booking->phone = $event->phone;

        return view('booking_after', compact('booking', 'service'));
    }

    public function check_exist_book($date, $time_slot_id){
        $events = Event::where('date', '=' , $date)->pluck('id');
        if (count($events) > 0) {
            $events_and_time_slots = EventAndTimeSlot::whereIn('event_id', $events)->pluck('time_slot_id');
            $busy_time_slots = TimeSlot::whereIn('id', $events_and_time_slots)->get();
            foreach ($busy_time_slots as $busy_time_slot){
                if($busy_time_slot->id === $time_slot_id){
                    return true;
                }
            }
            return false;
        }
    }
    public function getBooked(Request $request) {
        $now_date = new DateTime();

        $date_now_format = $now_date->format('Y-m-d H:i:s');
        $vowels = array("+", "(", ")", "-", " ");
        $format_phone = str_replace($vowels, "", $request->phone);
        $event = Event::where('phone', '=', $format_phone)->latest()->first();
        if($event){
            $event_date = new DateTime($event->start_time);
            $event_date_format = $event_date->format('Y-m-d H:i:s');
        }
        if($event === null || $date_now_format >= $event_date_format) {
            $service = '';
            $status_code = 422;
            $msg = "Ничего не найдено";
            if ($request->ajax()) {
                return response()->json(['message' => $msg], $status_code);
            }
        } else {
            $service = Service::where('id', '=', intval($event->name_service))->first();
        }
        return view('get_booking', compact('event', 'service'));
    }
}
