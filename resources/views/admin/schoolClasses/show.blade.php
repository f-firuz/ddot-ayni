@extends('layouts.admin')
@section('content')

<div class="card shadow p-3 mb-5 bg-body-tertiary rounded">
    <div class="card-header" style="color: #ff6a00; font-weight: bold ; background-color:white;">
        {{ trans('global.show') }}
    </div>

    <div class="card-body">
        <div class="form-group">

            <table class="table  ">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.schoolClass.fields.id') }}
                        </th>
                        <td>
                            {{ $schoolClass->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.schoolClass.fields.name') }}
                        </th>
                        <td>
                            {{ $schoolClass->name }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-outline-dark" href="{{ route('admin.school-classes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header" style="color: #ff6a00; font-weight: bold ; background-color:white;">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#class_lessons" role="tab" data-toggle="tab">
                {{ trans('cruds.lesson.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#class_users" role="tab" data-toggle="tab">
                {{ trans('cruds.user.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="class_lessons">
            @includeIf('admin.schoolClasses.relationships.classLessons', ['lessons' => $schoolClass->classLessons])
        </div>
        <div class="tab-pane" role="tabpanel" id="class_users">
            @includeIf('admin.schoolClasses.relationships.classUsers', ['users' => $schoolClass->classUsers])
        </div>
    </div>
</div>

@endsection