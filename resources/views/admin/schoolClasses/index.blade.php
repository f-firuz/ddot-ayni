@extends('layouts.admin')
@section('content')
@can('school_class_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-outline-dark" href="{{ route("admin.school-classes.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.schoolClass.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card shadow p-3 mb-5 bg-body-tertiary rounded">
<div class="card-header " style="color: #ff6a00; font-weight: bold ; background-color:white;" >
        {{ trans('cruds.schoolClass.title') }}
    </div>

    <div class="card-body ">
        <div class="table-responsive ">
            <table class=" table  table-hover datatable datatable-SchoolClass ">
                <thead>
                    <tr>
                        <th>

                        </th>
                        <th>
                            {{ trans('cruds.schoolClass.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.schoolClass.fields.name') }}
                        </th>
                        <th>
                            Расписание
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($schoolClasses as $key => $schoolClass)
                        <tr data-entry-id="{{ $schoolClass->id }}" class="text-center" >
                           <td width="10"></td>
                            <td>
                                {{ $schoolClass->id ?? '' }}
                            </td>
                            <td>
                                {{ $schoolClass->name ?? '' }}
                            </td>
                            <td>
                                <a href="{{ route('admin.calendar.index') }}?class_id={{ $schoolClass->id }}">Посмотреть расписание</a>
                            </td>
                            <td>
                                @can('school_class_show')
                                    <!-- <a class="btn btn-xs btn-primary" href="{{ route('admin.school-classes.show', $schoolClass->id) }}">
                                        {{ trans('global.view') }} -->

                                    <a class="btn btn-xs btn btn-xs btn-outline-dark" href="{{ route('admin.school-classes.show', $schoolClass->id) }}">
                                       <i class="bi bi-eye-fill"></i>
                                    <!-- {{ trans('global.view') }} -->

                                    </a>
                                @endcan

                                @can('school_class_edit')
                                    <!-- <a class="btn btn-xs btn-info" href="{{ route('admin.school-classes.edit', $schoolClass->id) }}">
                                        {{ trans('global.edit') }} -->

                                    <a class="btn btn-xs btn-outline-dark" href="{{ route('admin.school-classes.edit', $schoolClass->id) }}">
                                    <i class="bi bi-pencil-fill"></i>
                                    <!-- {{ trans('global.edit') }} -->

                                    </a>
                                @endcan

                                @can('school_class_delete')
                                    <form action="{{ route('admin.school-classes.destroy', $schoolClass->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">


                                        <button type="submit" class=" btn btn-xs btn btn-xs btn-danger"><i class="bi bi-trash3-fill "></i></button>
                                        
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
@can('school_class_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.school-classes.massDestroy') }}",
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
  $('.datatable-SchoolClass:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection
