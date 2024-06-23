@extends('layouts.admin')
@section('content')

<div class="card shadow p-3 mb-5 bg-body-tertiary rounded">
    <div class="card-header " style="color: #ff6a00; font-weight: bold ; background-color:white;" >
    </div>
    <div class="card-body">
        <div class="table-responsive">
                
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
