<!-- @extends('layouts.admin') -->
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow p-3 mb-5 bg-body-tertiary rounded">
                <div class="card-header " style="color: #ff6a00; font-weight: bold ; background-color:white;" >
                        Расписание
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table class="table table-bordered ">
                            <thead class="">
                                <th width="125" class=""> <span style="color: #8f8f8f; font-weight: normal;font-size:11px">Время</span></th>
                                    @foreach ($weekDays as $day)
                                        <th > <span style="color: #8f8f8f; font-weight: normal;font-size:11px">{{ $day }}</span> </th>
                                    @endforeach
                            </thead>
                            <tbody>
                                @foreach ($calendarData as $time => $days)
                                    <tr>
                                        <td class="text-center" >
                                            <span style="color: #8f8f8f; font-weight: normal; font-size:11px">{{ $time }} </span>
                                        </td>
                                        @foreach ($days as $value)
                                                @if (is_array($value))
                                                        <td rowspan="{{ $value['rowspan'] }}" class="align-middle ">
                                                                        <ul class="list-group " style="font-size:9px ; color: #f59604;">
                                                                            <li class="list-group-item"><b>Факультет :</b> <span >{{ $value['facultet'] }}</span></li>
                                                                            <li class="list-group-item"><b>Специальносты :</b> <span>{{ $value['class_name'] }}</span></li>
                                                                            <li class="list-group-item"><b>Учитель: </b><span>{{ $value['teacher_name'] }}</span></li>
                                                                            <li class="list-group-item"><b>Предмет: </b><span>{{ $value['subject_name'] }}</span></li>
                                                                            <li class="list-group-item"><b>Курс: </b><span>{{ $value['cours'] }}</span></li>
                                                                        </ul>
                                                                    </td>
                                                @elseif ($value === 1)
                                                <td></td>
                                            @endif
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </div>


    <style>
        span {
            color: black;
            font-weight: bold;
            
        }
        .list-group-item {
            border:0px solid red;
            padding:3px;
        }
    </style>
@endsection
@section('scripts')
    @parent
@endsection
