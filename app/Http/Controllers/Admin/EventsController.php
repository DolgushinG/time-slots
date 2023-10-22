<?php

namespace App\Http\Controllers\Admin;

use App\Event;
use App\EventAndTimeSlot;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEventRequest;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Service;
use App\TimeSlot;
use DateTime;
use Gate;
use Illuminate\Http\Request;
use stdClass;
use Symfony\Component\HttpFoundation\Response;

class EventsController extends Controller
{
    public function index()
    {

        abort_if(Gate::denies('event_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $events = Event::withCount('events')
            ->get();
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        abort_if(Gate::denies('event_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $services = Service::all();
        $time_slots = TimeSlot::all();

        return view('admin.events.create', compact('services', 'time_slots'));
    }

    public function store(StoreEventRequest $request)
    {
        $time_slot = TimeSlot::where('id', $request->time_slot_id)->first()->time_slot;
        $date = new DateTime($request->start_time.' '.$time_slot);
        $start_time = $date->format('Y-m-d H:i:s');
        $date_start_time = $date->format('Y-m-d');
        $end_time = date("Y-m-d H:i:s", strtotime('+2 hours', strtotime($start_time)));
        $event = new Event();
        $event->name = $request->name;
        $event->phone = $request->phone;
        $event->start_time = $start_time;
        $event->date = $date_start_time;
        $event->end_time = $end_time;
        $event->service_id = $request->service_id;
        $event->recurrence = 'none';
        $event->save();
        $eat = new EventAndTimeSlot();
        $eat->event_id = $event->id;
        $eat->time_slot_id = $request->time_slot_id;
        $eat->save();
        return redirect()->route('admin.systemCalendar');
    }

    public function edit(Event $event)
    {
        abort_if(Gate::denies('event_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $event->load('event')
            ->loadCount('events');
        $services = Service::all();
        return view('admin.events.edit', compact(['event', 'services']));
    }

    public function update(UpdateEventRequest $request, Event $event)
    {
        $event->update($request->all());

        return redirect()->route('admin.systemCalendar');
    }

    public function show(Event $event)
    {
        abort_if(Gate::denies('event_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $event->load('event');
        $name_service = Service::where('id', $event->service_id)->first()->name_service;
        $price = Service::where('id', $event->service_id)->first()->price;
        return view('admin.events.show', compact(['event', 'name_service', 'price']));
    }

    public function destroy(Event $event)
    {
        abort_if(Gate::denies('event_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $event->delete();

        return back();
    }

    public function massDestroy(MassDestroyEventRequest $request)
    {
        Event::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
