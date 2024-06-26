<?php

namespace App\Http\Requests;

use App\Lesson;
use App\Rules\LessonTimeAvailabilityRule;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreLessonRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('lesson_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'class_id'   => [
                'integer'],
            'teacher_id' => [
                'integer'],
            'weekday'    => [
                'integer',],
            'start_time' => [
                // new LessonTimeAvailabilityRule(),
                // 'date_format:' . config('panel.lesson_time_format')
            ],
            'end_time'   => [
                // 'after:start_time',
                // 'date_format:' . config('panel.lesson_time_format')
            ],
        ];
    }
}
