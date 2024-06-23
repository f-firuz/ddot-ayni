@extends('layouts.admin')
@section('content')

<div class="" style="display: flex;
flex-direction: row-reverse;
justify-content: space-evenly;
">

<div class="card shadow p-3 mb-5 bg-body-tertiary rounded col-xl-5">
    <div class="card-header" style="color: #ff6a00; font-weight: bold ; background-color:white;">
        <!-- {{ trans('global.show') }} {{ trans('cruds.lesson.title') }} -->
        Вид оценки
    </div>

    <div class="card-body">
        <div class="form-group">

            <table class="table  ">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.lesson.fields.id') }}
                        </th>
                        <td>
                            {{ $typegrades->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <!-- {{ trans('cruds.lesson.fields.class') }} -->
                            Имя
                        </th>
                        <td>
                            {{ $typegrades->name ?? '' }}
                        </td>
                    </tr>

                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-outline-dark" href="{{ route('admin.type-grades.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>
</div>



@endsection
