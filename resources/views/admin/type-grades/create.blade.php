@extends('layouts.admin')
@section('content')
<div class="" style="display: flex;
flex-direction: row-reverse;
justify-content: space-evenly;
">
    <div class="card shadow p-3 mb-5 bg-body-tertiary rounded  col-xl-4">
        <div class="card-header" style="color: #8f8f8f; font-weight: bold">
            <!-- {{ trans('global.create') }} {{ trans('cruds.lesson.title_singular') }} -->
            Создать тип оценки
        </div>

        <div class="card-body  text  ">
            <form method="POST" action="{{ route("admin.type-grades.store") }}"  enctype="multipart/form-data" class="row g-3">
                @csrf

                <div class="col-md-12">
                    <label class="required" for="type_grades">Имя</label>
                    <input class="form-control"
                        type="text" name="name" id="name"  required>
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