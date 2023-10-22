<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTimeSlotRequest;
use App\Http\Requests\StoreTimeSlotRequest;
use App\Http\Requests\UpdateTimeSlotRequest;
use App\TimeSlot;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class TimeSlotsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('time_slot_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $time_slots = TimeSlot::all();
        return view('admin.time_slots.index', compact('time_slots'));
    }

    public function create()
    {
        abort_if(Gate::denies('time_slot_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.time_slots.create');
    }

    public function store(StoreTimeSlotRequest $request)
    {
        TimeSlot::create($request->all());

        return redirect()->route('admin.time_slots.index');
    }

    public function edit(TimeSlot $time_slot)
    {
        abort_if(Gate::denies('service_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.time_slots.edit', compact('time_slot'));
    }

    public function update(UpdateTimeSlotRequest $request, TimeSlot $time_slot)
    {
        $time_slot->update($request->all());

        return redirect()->route('admin.time_slots.index');
    }

    public function show(TimeSlot $time_slot)
    {
        abort_if(Gate::denies('time_slot_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.time_slots.show', compact('time_slot'));
    }

    public function destroy(TimeSlot $time_slot)
    {
        abort_if(Gate::denies('time_slot_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $time_slot->delete();

        return back();
    }

    public function massDestroy(MassDestroyTimeSlotRequest $request)
    {
        TimeSlot::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
