@extends('layouts.admin')
@section('content')
    @can('user_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-outline-dark" href="{{ route("admin.users.create") }}">
                    {{ trans('global.add') }} {{ trans('cruds.user.title_singular') }}
                </a>
                <a class="btn btn-outline-dark" href="{{ route("admin.users.create") }}?student">
                    Добавить студента
                </a>
            </div>
        </div>
    @endcan
    <div class="card shadow p-3 mb-5 bg-body-tertiary rounded">
    <div class="card-header " style="color: #ff6a00; font-weight: bold ; background-color:white;" >
            {{ trans('cruds.user.title_singular') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table   table-hover datatable datatable-User text-center">
                    <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.user.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.facultet') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.class_id') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.cours') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.phone') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>



                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($studens as $key => $studen)
                        <tr data-entry-id="{{ $studen->id }}" class="text-center">
                            <td>

                            </td>
                            <td>
                                {{ $studen->id ?? '' }}
                            </td>
                            <td>
                                {{ $studen->name ?? '' }}
                            </td>
                            <td>
                                {{ $studen->facultet->name ?? '' }}
                            </td>
                            <td>
                                {{ $studen->class->name ?? '' }}
                            </td>
                            <td>
                                {{ $studen->id_cours ?? '' }}
                            </td>
                            <td>
                                {{ $studen->phone ?? '' }}
                            </td>

                            <td>
                                {{ $studen->email ?? '' }}
                            </td>
                            <!-- <td>
                                {{ $studen->email_verified_at ?? '' }}
                            </td> -->


                            <td>
                                @can('user_show')
                                    <a class="btn btn-xs btn-outline-dark" href="{{ route('admin.users.show', $studen->id) }}">
                                        <!-- {{ trans('global.view') }} -->
                                        <i class="bi bi-eye-fill"></i>

                                    </a>
                                @endcan

                                @can('user_edit')
                                    <a class="btn btn-xs btn-outline-dark" >
                                        <!-- {{ trans('global.edit') }} -->
                                        <i class="bi bi-pencil-fill"></i>

                                    </a>
                                @endcan

                                @can('user_delete')
                                    <form action="{{ route('admin.users.destroy', $studen->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <i class="bi bi-trash3-fill btn btn-xs btn-danger"></i>

                                        <!-- <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}"> -->
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>



@endsection
@section('scripts')
    @parent
    <script>
        $(function () {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('user_delete')
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.users.massDestroy') }}",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                    var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
                        return $(entry).data('entry-id')
                    });

                    if (ids.length === 0) {
                        alert('{{ trans('global.datatables.zero_selected') }}')

                        return
                    }

                    if (confirm('{{ trans('global.areYouSure') }}')) {
                        $.ajax({
                            headers: {'x-csrf-token': _token},
                            method: 'POST',
                            url: config.url,
                            data: { ids: ids, _method: 'DELETE' }})
                            .done(function () { location.reload() })
                    }
                }
            }
            dtButtons.push(deleteButton)
            @endcan

            $.extend(true, $.fn.dataTable.defaults, {
                order: [[ 1, 'desc' ]],
                pageLength: 10,
            });
            $('.datatable-User:not(.ajaxTable)').DataTable({ buttons: dtButtons })
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });
        })

    </script>
@endsection
