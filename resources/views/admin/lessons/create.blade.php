@extends('layouts.admin')
@section('content')
<div class="" style="display: flex;
flex-direction: row-reverse;
justify-content: space-evenly;
">
    <div class="card shadow p-3 mb-5 bg-body-tertiary rounded  col-xl-8">
    <div class="card-header" style="color: #ff6a00; font-weight: bold ; background-color:white;">
            {{ trans('global.create') }} {{ trans('cruds.lesson.title_singular') }}
        </div>

        <div class="card-body  text  ">
            <form method="POST" action="{{ route("admin.lessons.store") }}"  enctype="multipart/form-data" class="row g-3">
                @csrf
                <!-- Факультет -->
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Факультет</label>
                    <select class="form-control select2 " name="id_faculties" id="id_faculties" required>
                        @foreach($facultets as $id => $class)
                        <option value="{{ $id }}">{{ $class }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('class'))
                    <div class="invalid-feedback">
                        {{ $errors->first('class') }}
                    </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.lesson.fields.class_helper') }}</span>
                </div>
                <!-- Специальносты -->
                <div class="col-6">
                    <label class="required" for="class_id">Специальносты</label>
                    <select class="form-control select2 " name="class_id" id="class_id" required>
                        @foreach($classes as $id => $class)
                        <option value="{{ $id }}">{{ $class }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('class'))
                    <div class="invalid-feedback">
                        {{ $errors->first('class') }}
                    </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.lesson.fields.class_helper') }}</span>
                </div>
                <!-- Курс -->

                <div class="col-6">
                    <label class="required" for="class_id">Курс</label>
                    <select class="form-control select2 " name="id_cours" id="id_cours" required>
                        @foreach($cours as $id => $cour)
                        <option value="{{ $id }}">{{ $cour }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('cour'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cour') }}
                    </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.lesson.fields.class_helper') }}</span>
                </div>
                <!-- Учителы -->

                <div class="col-6">
                    <label class="required" for="teacher_id">{{ trans('cruds.lesson.fields.teacher') }}</label>
                    <select class="form-control select2 " name="teacher_id" id="teacher_id" required>
                        @foreach($teachers as $id => $teacher)
                        <option value="{{ $id }}">{{ $teacher }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('teacher'))
                    <div class="invalid-feedback">
                        {{ $errors->first('teacher') }}
                    </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.lesson.fields.teacher_helper') }}</span>
                </div>
                <!-- Предметы -->

                <div class="col-md-6">
                    <label class="required" for="subjects">{{ trans('cruds.lesson.fields.subjects') }}</label>
                    <select class="form-control select2 " name="id_subjects" id="id_subjects" required>

                        @foreach($subjects as $id => $sub)
                        <option value="{{ $id }}">{{ $sub }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('$sub'))
                    <div class="invalid-feedback">
                        {{ $errors->first('$sub') }}
                    </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.lesson.fields.subjects_helper') }}</span>
                </div>
                <!-- Аудитория -->

                <div class="col-md-2">
                    <label class="required" for="audit">{{ trans('cruds.lesson.fields.audit') }}</label>
                    <select class="form-control select2 " name="id_audiences" id="id_audiences" required>

                        @foreach($audit as $id => $aut)
                        <option value="{{ $id }}">{{ $aut }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('$aut'))
                    <div class="invalid-feedback">
                        {{ $errors->first('$aut') }}
                    </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.lesson.fields.audit_helper') }}</span>
                </div>
                <!-- Будний день -->

                <div class="col-md-4">
                    <label class="required" for="weekday">{{ trans('cruds.lesson.fields.weekday') }}</label>
                    <select class="form-control select2 " name="weekday" id="weekday" required>

                        @foreach($weeks as $id => $wek)
                        <option value="{{ $id }}">{{ $wek }}</option>
                        @endforeach
                    </select>


                    @if($errors->has('weekday'))
                    <div class="invalid-feedback">
                        {{ $errors->first('weekday') }}
                    </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.lesson.fields.weekday_helper') }}</span>
                </div>
                <!-- Пары -->
                <div class="col-md-4">
                    <!-- <label class="required" for="weekday">{{ trans('cruds.lesson.fields.weekday') }}</label> -->
                    Пары
                    <select class="form-control select2 " name="par" id="par" required>

                        @foreach($par as $id => $pars)
                        <option value="{{ $id }}">{{ $pars}}</option>
                        @endforeach
                    </select>


                    @if($errors->has('weekday'))
                    <div class="invalid-feedback">
                        {{ $errors->first('weekday') }}
                    </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.lesson.fields.weekday_helper') }}</span>
                </div>
                <!-- Время начала -->

                <div class="col-md-4">
                    <!-- <label class="required" for="start_time">{{ trans('cruds.lesson.fields.start_time') }}</label> -->
                    Время начала
                    <input class="form-control lesson-timepicker {{ $errors->has('start_time') ? 'is-invalid' : '' }}"
                        type="text" name="start_time" id="start_time" value="{{ old('start_time') }}" required>
                    @if($errors->has('start_time'))
                    <div class="invalid-feedback">
                        {{ $errors->first('start_time') }}
                    </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.lesson.fields.start_time_helper') }}</span>
                </div>
                <!-- Время окончания -->
                <div class="col-md-4">
                    <!-- <label class="required" for="end_time">{{ trans('cruds.lesson.fields.end_time') }}</label> -->
                    Время окончания
                    <input class="form-control lesson-timepicker {{ $errors->has('end_time') ? 'is-invalid' : '' }}"
                        type="text" name="end_time" id="end_time" value="{{ old('end_time') }}" required>
                    @if($errors->has('end_time'))
                    <div class="invalid-feedback">
                        {{ $errors->first('end_time') }}
                    </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.lesson.fields.end_time_helper') }}</span>
                </div>
                <!-- Сохранить  -->
                <div class="col-12 pt-3">
                    <button class="btn btn-primary" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>











@endsection