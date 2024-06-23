@extends('layouts.admin')
@section('content')

<div class="card shadow p-3 mb-5 bg-body-tertiary rounded">
<div class="card-header" style="color: #ff6a00; font-weight: bold ; background-color:white;">
        <!-- {{ trans('global.create') }} {{ trans('cruds.schoolClass.title_singular') }} -->
        Создать факультета
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.create-facultets.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.schoolClass.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.schoolClass.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection