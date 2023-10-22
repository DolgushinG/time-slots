<?php

namespace App\Http\Requests;

use App\Event;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateTimeSlotRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('time_slot_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'time_slot'       => [
                'required',
            ],
            'is_blocked'       => [
                'required',
            ],
        ];
    }
}
