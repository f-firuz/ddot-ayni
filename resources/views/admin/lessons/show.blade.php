@extends('layouts.admin')
@section('content')

<div class="" style="display: flex;
flex-direction: row-reverse;
justify-content: space-evenly;
">

    <div class="card shadow p-3 mb-5 bg-body-tertiary rounded col-xl-8">
        <div class="card-header" style="color: #ff6a00; font-weight: bold ; background-color:white;">
            {{ trans('global.show') }} {{ trans('cruds.lesson.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                {{-- <div class="form-group">--}}
                {{-- <a class="btn btn-default" href="{{ route('admin.lessons.index') }}">--}}
                {{-- {{ trans('global.back_to_list') }}--}}
                {{-- </a>--}}
                {{-- </div>--}}
                <table class="table  ">
                    <tbody>
                        <tr>
                            <th>
                                {{ trans('cruds.lesson.fields.id') }}
                            </th>
                            <td>
                                {{ $lesson->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.lesson.fields.class') }}
                            </th>
                            <td>
                                {{ $lesson->class->name ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.lesson.fields.teacher') }}
                            </th>
                            <td>
                                {{ $lesson->teacher->name ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.lesson.fields.weekday') }}
                            </th>
                            <td>
                                {{ $lesson->weekday }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.lesson.fields.start_time') }}
                            </th>
                            <td>
                                {{ $lesson->start_time }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.lesson.fields.end_time') }}
                            </th>
                            <td>
                                {{ $lesson->end_time }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-outline-dark" href="{{ route('admin.lessons.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection