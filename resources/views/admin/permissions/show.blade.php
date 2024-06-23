@extends('layouts.admin')
@section('content')

<div class="card shadow p-3 mb-5 bg-body-tertiary rounded">
    <div class="card-header" style="color: #ff6a00; font-weight: bold ; background-color:white;">
        {{ trans('global.show') }} {{ trans('cruds.permission.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            {{-- <div class="form-group">--}}
            {{-- <a class="btn btn-default" href="{{ route('admin.permissions.index') }}">--}}
            {{-- {{ trans('global.back_to_list') }}--}}
            {{-- </a>--}}
            {{-- </div>--}}
            <table class="table  ">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.permission.fields.id') }}
                        </th>
                        <td>
                            {{ $permission->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.permission.fields.title') }}
                        </th>
                        <td>
                            {{ $permission->title }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-outline-dark" href="{{ route('admin.permissions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card shadow p-3 mb-5 bg-body-tertiary rounded">
<div class="card-header" style="color: #ff6a00; font-weight: bold ; background-color:white;">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#permissions_roles" role="tab" data-toggle="tab">
                {{ trans('cruds.role.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="permissions_roles">
            @includeIf('admin.permissions.relationships.permissionsRoles', ['roles' => $permission->permissionsRoles])
        </div>
    </div>
</div>

@endsection