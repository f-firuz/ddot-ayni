@extends('layouts.admin')
@section('content')
@can('lesson_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-outline-dark" href="{{ route("admin.create-facultets.index") }}">
                <!-- {{ trans('global.add') }} {{ trans('cruds.lesson.title_singular') }} -->
                Добавить факультет
            </a>
        </div>
    </div>
@endcan
<div class="card shadow p-3 mb-5 bg-body-tertiary rounded">
    <div class="card-header " style="color: #ff6a00; font-weight: bold ; background-color:white;" >
        Список факультетов
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class=" table   text-center table-hover datatable datatable-Lesson" style="font-size:12px">
                <thead>
                    <tr>
                        <th>

                        </th>
                        <th>
                            {{ trans('cruds.lesson.fields.id') }}
                        </th>
                        <th>
                            Имя
                        </th>
                      
                        <th>
                            &nbsp;
                        </th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($facultets as $key => $facultet)
                        <tr data-entry-id="{{ $facultet->id }}" class="text-center">
                           <td width="10"></td>
                            <td>
                                {{ $facultet->id ?? '' }}
                            </td>
                            <td>
                                {{ $facultet->name}}
                            </td>
                        
                          
                            <td>
                                @can('lesson_show')
                                
                                    <a class="btn btn-xs btn-outline-dark " href="{{ route('admin.lessons.show', $facultet->id) }}">
                                        <i class="bi bi-card-checklist"></i>
                                        
                                    </a>
                                @endcan

                                @can('lesson_edit')
                                  

                                    <a class="btn btn-xs btn-outline-dark" href="{{ route('admin.facultets.edite', $facultet->id) }}">
                                        <i class="bi bi-pencil-fill"></i> <!-- {{ trans('global.edit') }} -->
                                    </a>
                                @endcan

                                @can('lesson_delete')
                                    <form action="{{ route('admin.destroy-facultets.destroy', $facultet->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="bi bi-trash3-fill btn btn-xs btn-danger" ></button>
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


  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 10,
  });
  $('.datatable-Lesson:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection
