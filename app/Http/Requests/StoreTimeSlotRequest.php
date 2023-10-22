<?php

namespace App\Http\Requests;

use App\Event;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreTimeSlotRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('time_slot_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'time_slot'       => [
                'required',
            ],
        ];
    }
}
