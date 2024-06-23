@extends('layouts.admin')
@section('content')
<div class="" style="display: flex;
flex-direction: row-reverse;
justify-content: space-evenly;
">
    <div class="card shadow p-3 mb-5 bg-body-tertiary rounded col-xl-12">
    <div class="card-header " style="color: #ff6a00; font-weight: bold ; background-color:white;" >
            <!-- {{ trans('global.list') }} -->
            Выд оценки
       
            <div style="margin-bottom: 10px;" class="row float-right">
                <div class="col-lg-12">
                    <a class="btn btn-outline-danger" href="{{ route("admin.type-grades.creates") }}">
                        <!-- {{ trans('global.add') }} {{ trans('cruds.lesson.title_singular') }} -->
                        Добавить
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" text-right table   table-hover datatable datatable-Lesson" style="font-size:12px">
                    <thead>
                        <tr>
                            <th width="60">
                                Имя
                            </th>

                            <th>
                               Действия &nbsp;
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($typegrades as $key => $typegrade)
                        <tr data-entry-id="{{ $typegrade->id }}" class="text-center">
                            <td>
                                {{ $typegrade->name ?? '' }}
                            </td>
                            <td >
                                <div class="float-right">

                                    <a class="btn btn-xs btn-outline-dark " >
                                    <i class="bi bi-card-checklist"></i>

                                </a>
                                <a class="btn btn-xs btn-outline-dark" >
                                    <i class="bi bi-pencil-fill"></i> 
                                </a>

                                <for method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="bi bi-trash3-fill btn btn-xs btn-danger" ></button>
                                        <!-- <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}"> -->
                                    </for>
                                </div>
                              

                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function() {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
        @can('lesson_delete')
        let deleteButtonTrans = '{{ trans('
        global.datatables.delete ') }}'
        let deleteButton = {
            text: deleteButtonTrans,
            url: "{{ route('admin.lessons.massDestroy') }}",
            className: 'btn-danger',
            action: function(e, dt, node, config) {
                var ids = $.map(dt.rows({
                    selected: true
                }).nodes(), function(entry) {
                    return $(entry).data('entry-id')
                });

                if (ids.length === 0) {
                    alert('{{ trans("global.datatables.zero_selected") }}')

                    return
                }

                if (confirm('{{ trans('
                        global.areYouSure ') }}')) {
                    $.ajax({
                            headers: {
                                'x-csrf-token': _token
                            },
                            method: 'POST',
                            url: config.url,
                            data: {
                                ids: ids,
                                _method: 'DELETE'
                            }
                        })
                        .done(function() {
                            location.reload()
                        })
                }
            }
        }
        dtButtons.push(deleteButton)
        @endcan

        $.extend(true, $.fn.dataTable.defaults, {
            order: [
                [1, 'desc']
            ],
            pageLength: 10,
        });
        $('.datatable-Lesson:not(.ajaxTable)').DataTable({
            buttons: dtButtons
        })
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });
    })
</script>
@endsection