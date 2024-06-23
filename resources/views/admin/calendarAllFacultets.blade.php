<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
    rel="stylesheet">
<link href="{{ asset('css/style.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">



<div class="content">
    <div class="pt-3">
        <div class="col-lg-12">
            <div class="card shadow p-3 mb-5 bg-body-tertiary rounded">
                <div class="card-header  " style="color: black; font-weight: bold ; background-color:white;">

                    <span class="text-black">Факультета:</span> <span style="color:#ff6a00">{{ $resfacultForTable }}
                    </span> <span class="text-black">Курс: </span><span style="color:#ff6a00">{{ $getcours }}</span>
                    <div class="float-right text-white">
                        {{$nedeli}} - {{date('d-m-Y')}}
                        <div class="float-right ml-1" id="clock" style="color:#ff6a00"></div>
                    </div>
                </div>

                <div class="card-body">

                    <table class="text-center table-bordered table-hover" style="width:100%" id="gradesTable myTable">
                        <tbody id="tableBodyContents">
                            <tr>
                                    <td> 
                                        <span style="color: #070707; font-weight: bold;font-size:8px;">Специальности</span>
                                    </td>
                                        <td width="56" class=""> <span style="color: #070707; font-weight: bold;font-size:8px">Время</span>
                                    </td>

                                    @foreach ($weekDays as $key => $day)
                                        <td>
                                            <span style="color: #070707; font-weight: bold; font-size:8px">{{ $day }}</span>
                                        </td>
                                    @endforeach
                                    </tr>

                                    @foreach ($specialtys as $key => $specialty)
                                        <tr>
                                            <th class="text-center" rowspan="11" style="width: 71px;">
                                                <span style="font-weight: bold; font-size:8px; color:#ff6a00; writing-mode: vertical-rl;">
                                                    {{ $specialty->name }}
                                                </span>
                                            </th>

                                            @foreach ($calendarData[$specialty->id] ?? [] as $time => $days)
                                                <tr>
                                                    <td>
                                                        <span style="color: #070707; font-weight: bold; font-size:6px">{{ $time }}</span>
                                                    </td>

                                                    @foreach ($days as $key => $value)
                                                        @if (isset($value['class_name']) && $value['class_name'] == $specialty->name)
                                                            @php
                                                                $currentDay = $weekDays[$key + 1] ?? ''; // 
                                                            @endphp
                                                            @if (isset($value['live']) && $value['live'] == false)
                                                            <td rowspan="{{ $value['rowspan'] }}"
                                                                    class="text-cell draggable droppable cell schedule-cell"
                                                                    draggable="true" 
                                                                    data-par="{{ $value['par'] }}" 
                                                                    data-subject_name="{{ $value['subject_name'] }}" 
                                                                    data-teacher_name="{{ $value['teacher_name'] }}" 
                                                                    data-id="{{ $value['id'] }}">
                                                                    
                                                                    <b style="font-size:8px">Учитель: <span style="color: #ff6a00;font-size:8px">{{ $value['teacher_name'] }}</span></b>
                                                                    <b style="font-size:8px">Предмет: <span style="color: #ff6a00;font-size:8px">{{ $value['subject_name'] }}</span></b>
                                                                    <b style="font-size:8px">Аудитория: <span style="color: #ff6a00;font-size:8px">{{ $value['par'] }}</span></b>
                                                                    {{ $currentDay }} - {{ $time }}
                                                                </td>
                                                            @else
                                                                <td rowspan="{{ $value['rowspan'] }}" class="text-cell draggable droppable cell schedule-cell"
                                                                    draggable="true" style="background-color: white;"
                                                                    class="text-cell draggable droppable cell schedule-cell"
                                                                    draggable="true" 
                                                                    data-par="{{ $value['par'] }}" 
                                                                    data-subject_name="{{ $value['subject_name'] }}" 
                                                                    data-teacher_name="{{ $value['teacher_name'] }}" 
                                                                    data-id="{{ $value['id'] }}">
                                                                    <b style="font-size:8px">Учитель: <span style="color: #ff6a00;font-size:8px">{{ $value['teacher_name'] }}</span></b>
                                                                    <b style="font-size:8px">Предмет: <span style="color: #ff6a00;font-size:8px">{{ $value['subject_name'] }}</span></b>
                                                                    <b style="font-size:8px">Аудитория: <span style="color: #ff6a00;font-size:8px">{{ $value['par'] }}</span></b>

                                                                    @if (isset($value['live']) && $value['live'] == 1)
                                                                        <div class="livenow">
                                                                            <div></div>
                                                                            <div></div>
                                                                            <div></div>
                                                                        </div>
                                                                        <span class="ml-2 "></span>
                                                                    @endif
                                                                    {{ $currentDay }} - {{ $time }}
                                                                </td>
                                                            @endif
                                                        @else
                                                            <td class="droppable schedule-cell" draggable="true" >-</td>
                                                        @endif
                                                    @endforeach
                                                </tr>
                                            @endforeach

                                            @if (empty($calendarData[$specialty->id]))
                                                <tr>
                                                    <td colspan="8">Нет данных для специальности {{ $specialty->name }}</td>
                                                </tr>
                                            @endif
                                        </tr>
                                    @endforeach

                        </tbody>
                    </table>



                    <div class="card-header" style="color: black; font-weight: bold ; background-color:white;">
                        <span class="text-black">Факультета:</span> <span style="color:#ff6a00">{{ $resfacultForTable }}</span>
                        <span class="text-black">Курс: </span><span style="color:#ff6a00">{{ $getcours }}</span>
                        <div class="float-right text-black">
                            {{ $nedeli }} - {{ date('d-m-Y') }}
                            <div class="float-right ml-1" id="clock_2" style="color:#ff6a00"> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</div>

<!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eventModalLabel">Изменить урок</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="eventForm">
                    <div class="form-group">
                        <label for="eventTitle">Название предмета</label>
                        <input type="text" class="form-control" id="eventTitle" required>
                    </div>
                    <div class="form-group">
                        <label for="eventPar">Аудитория</label>
                        <input type="text" class="form-control" id="eventPar" required>
                    </div>
                    <div class="form-group">
                        <label for="eventTeacher">Учитель</label>
                        <input type="text" class="form-control" id="eventTeacher" required>
                    </div>
                    <input type="hidden" id="eventId">
                    <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                </form>
            </div>
        </div>
    </div>
</div>

  <!-- Modal -->
  <div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventModalLabel">Изменить урок</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="eventForm">
                        <div class="form-group">
                            <label for="eventTitle">Название предмета</label>
                            <input type="text" class="form-control" id="eventTitle" required>
                        </div>
                        <div class="form-group">
                            <label for="eventPar">Аудитория</label>
                            <input type="text" class="form-control" id="eventPar" required>
                        </div>
                        <div class="form-group">
                            <label for="eventTeacher">Учитель</label>
                            <input type="text" class="form-control" id="eventTeacher" required>
                        </div>
                        <input type="hidden" id="eventId">
                        <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <!-- Custom Script -->
    <script>
        $(document).ready(function() {
            $('.schedule-cell').on('click', function() {
                var subject_name = $(this).data('subject_name');
                var par = $(this).data('par');
                var teacher_name = $(this).data('teacher_name');
                var id = $(this).data('id');

                $('#eventTitle').val(subject_name);
                $('#eventPar').val(par);
                $('#eventTeacher').val(teacher_name);
                $('#eventId').val(id);

                $('#eventModal').modal('show');
            });

            $('#eventForm').on('submit', function(e) {
                e.preventDefault();
                var title = $('#eventTitle').val();
                var par = $('#eventPar').val();
                var teacher_name = $('#eventTeacher').val();
                var id = $('#eventId').val();

                $.ajax({
                    url: '{{ url("admin/lessons") }}/' + id,
                    type: 'PUT',
                    data: {
                        _token: '{{ csrf_token() }}',
                        title: title,
                        par: par,
                        teacher_name: teacher_name,
                    },
                    success: function(response) {
                        if (response.success) {
                            var cell = $('td[data-id="' + id + '"]');
                            cell.find('span').eq(0).text('Учитель: ' + teacher_name);
                            cell.find('span').eq(1).text('Предмет: ' + title);
                            cell.find('span').eq(2).text('Аудитория: ' + par);
                            $('#eventModal').modal('hide');
                            $('#eventForm')[0].reset();
                        } else {
                            alert('Ошибка при сохранении урока');
                        }
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                        alert('Произошла ошибка при обновлении урока!');
                    }
                });
            });
        });
    </script>


<style>
    .notification {
        position: fixed;
        top: 100px;
        right: 1030px;
        background-color: #444;
        color: #fff;
        padding: 10px;
        border-radius: 5px;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .notification.show {
        opacity: 1;
    }

    .draggable {
        cursor: move;
    }

    .droppable {
        border: 1px solid #000;
    }

    .dragging {
        opacity: 0.5;
    }

    .red-text {
        background-color: #e3e3e3;
        color: black;
    }



    .blue-text {
        background-color: white;
        color: black
    }

    .livenow {
        margin: 0 auto;
        display: inline-block;
        padding: 8px;
    }

    .livenow>div {
        vertical-align: middle;
        width: 12px;
        height: 12px;
        border-radius: 100%;
        position: absolute;
        margin: 0 auto;
        -webkit-animation: live 1.4s infinite ease-in-out;
        animation: live 1.4s infinite ease-in-out;
        -webkit-animation-fill-mode: both;
        animation-fill-mode: both;

        &:nth-child(1) {
            background-color: rgba(255, 0, 0, 0.3);
            background-color: rgba(255, 0, 0, 173);
            -webkit-animation-delay: -0.1s;
            animation-delay: -0.1s;
        }

        &:nth-child(2) {
            -webkit-animation-delay: 0.16s;
            animation-delay: 0.16s;
        }

        &:nth-child(3) {
            -webkit-animation-delay: 0.42s;
            animation-delay: 0.42s;
            border: 3px solid rgba(255, 0, 0, 0.5);
        }

        &:nth-child(4) {
            border: 3px solid rgba(255, 0, 0, 1);
            -webkit-animation-delay: -0.42s;
            animation-delay: -0.42s;
        }

    }

    @-webkit-keyframes live {

        0%,
        80%,
        100% {
            -webkit-transform: scale(0.6)
        }

        40% {
            -webkit-transform: scale(1.0)
        }
    }

    @keyframes live {

        0%,
        80%,
        100% {
            transform: scale(0.6);
            -webkit-transform: scale(0.6);
        }

        40% {
            transform: scale(1.0);
            -webkit-transform: scale(1.0);
        }
    }
</style>
<script type="text/javascript">
    document.addEventListener('dragstart', function (e) {
        e.target.classList.add('dragging');
        e.dataTransfer.setData('text/html', e.target.innerHTML);
    });

    document.addEventListener('dragend', function (e) {
        e.target.classList.remove('dragging');
    });

    document.addEventListener('dragover', function (e) {
        e.preventDefault();
    });

    document.addEventListener('dragenter', function (e) {
        if (e.target.classList.contains('droppable')) {
            e.target.style.border = '2px dashed #c8ced3';
        }
    });

    document.addEventListener('dragleave', function (e) {
        if (e.target.classList.contains('droppable')) {
            e.target.style.border = '1px solid #c8ced3';
        }
    });

    document.addEventListener('drop', function (e) {
        if (e.target.classList.contains('droppable')) {
            e.preventDefault();
            e.target.style.border = '1px solid #c8ced3';
            let draggingElement = document.querySelector('.dragging');
            e.target.innerHTML = draggingElement.innerHTML;
            draggingElement.innerHTML = '-';
        }
    });

    // Добавляем обработчик события клика мыши на ячейки таблицы
    document.addEventListener('click', function (e) {
        // Проверяем, что клик был совершен внутри ячейки таблицы
        if (e.target.classList.contains('cell')) {
            // Получаем текст ячейки, на которую был совершен клик
            var cellText = e.target.textContent.trim(); // Получаем текст ячейки и удаляем пробелы в начале и конце

            // Выводим текст в консоль
            console.log('Clicked on cell with text: ' + cellText);

            // Или использовать alert()
            // alert('Clicked on cell with text: ' + cellText);
        }
    });
    // Добавляем обработчик события клика мыши на ячейки таблицы
    document.addEventListener('click', function (e) {
        // Проверяем, что клик был совершен внутри ячейки таблицы
        if (e.target.classList.contains('cell')) {
            // Получаем текст ячейки, на которую был совершен клик
            var cellText = e.target.textContent.trim(); // Получаем текст ячейки и удаляем пробелы в начале и конце

            // Проверяем, является ли ячейка пустой
            if (cellText === '') {
                // Выводим текст в консоль
                console.log('Clicked on empty cell');

                // Или использовать alert()
                // alert('Clicked on empty cell');
            }
        }
    });

    function updateTime_2() {
        var now = new Date();
        var hours = now.getHours();
        var minutes = now.getMinutes();
        var seconds = now.getSeconds();
        document.getElementById('clock_2').innerHTML = hours + ':' + minutes + ':' + seconds;
    }





    setInterval(updateTime_2, 1000);
    updateTime_2(); // Call initially to avoid delay
</script>