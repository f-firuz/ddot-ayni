@extends('layouts.admin')
@section('content')

<div class="card shadow p-3 mb-5 bg-body-tertiary rounded">
<div class="card-header" style="color: #ff6a00; font-weight: bold ; background-color:white;">
        {{ trans('global.show') }} {{ trans('cruds.role.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
{{--            <div class="form-group">--}}
{{--                <a class="btn btn-default" href="{{ route('admin.roles.index') }}">--}}
{{--                    {{ trans('global.back_to_list') }}--}}
{{--                </a>--}}
{{--            </div>--}}
            <table class="table  ">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.role.fields.id') }}
                        </th>
                        <td>
                            {{ $role->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.role.fields.title') }}
                        </th>
                        <td>
                            {{ $role->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.role.fields.permissions') }}
                        </th>
                        <td>
                            @foreach($role->permissions as $key => $permissions)
                                <span class="label label-info">{{ $permissions->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-outline-dark" href="{{ route('admin.roles.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card shadow p-3 mb-5 bg-body-tertiary rounded">
    <div class="card-header" style="color: #8f8f8f; font-weight: bold">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#roles_users" role="tab" data-toggle="tab">
                {{ trans('cruds.user.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="roles_users">
            @includeIf('admin.roles.relationships.rolesUsers', ['users' => $role->rolesUsers])
        </div>
    </div>
</div>

@endsection
