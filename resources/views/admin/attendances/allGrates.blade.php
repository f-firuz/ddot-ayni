@extends('layouts.admin')
@section('content')

@if ($errors->has('grades'))
    <div class="alert alert-danger">
        {{ $errors->first('grades') }}
    </div>
@endif


<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Добавление оценок
</button>

<div class="float-right">
    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal_1">Завершение урока</button>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal_1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <h1 class="modal-title fs-5" id="exampleModalLabel">Завершени урок</h1> -->
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                <!-- <i type="button" class="btn-close float-right" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-circle"></i></i> -->
                <p></p>
            </div>
            <div class="modal-body">
                <h5 class="text-center">Завершение урока!!!</h5>
            </div>

            @csrf
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                <button type="submit" id="submit" class="btn btn-primary" data-bs-dismiss="modal">Да</button>
            </div>


        </div>
    </div>
</div>

<div class="  mt-5" style="display: block">
    <h6><b>Факультет - </b> {{$faclForTableAttam}} <b>Специальносты - </b> {{ $speciForTableAttam }} <b>Курс -</b> {{ $cour_1 }}
        <b>Предметь - </b>{{ $subjectsAtt }}
    </h6>
    <table class=" table shadow table-bordered  " id="items-table" style="font-size:10px">

        <thead class="" id="items-table">
            <th colspan="1" rowspan="2">ФИО</th>
            <th colspan="31">{{ $currentMonthNameLocalized }}</th>
            <tr>
                @foreach ($daysOfMonth as $day)
                <td class="text-center {{ $day['isToday'] ? 'today' : '' }}  " style="font-size:8px ">
                    <b> {{ $day['date'] }} </b>
                </td>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($getAllStudent as $student)
            @if ($student != null)

            <tr>
                <td style="font-size:10px">
                    {{ $student->name }}
                    @foreach ($daysOfMonth as $key => $day)
                    @php
                    $grade = $student->grades->where('date_grades', $day['date_rev'])->first();
                    @endphp
                <td style="font-size:11px" class="editable1" data-id="{{ $grade != null ? $grade->id : '' }}">
                    @if ($grade != null)
                    {{ $grade->grades }}
                    @endif
                </td>
                @endforeach
                </td>
            </tr>
            @else
            <tr>
                <td colspan="{{ count($daysOfMonth) + 1 }}">Студенты не найдены.</td>
            </tr>
            @endif

            @endforeach
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    // Закрыть Урок
    document.getElementById('submit').addEventListener('click', function(event) {
        event.preventDefault(); // Предотвращает стандартное поведение отправки формы

        axios.post('/admin/closeLesson')
            .then(function(response) {
                showNotification('Урок успешно завершено', 'success');
                // Перенаправление на другую страницу
                window.location.href = '/admin/attendance';
            })
            .catch(function(error) {
                showNotification('Ошибка при  завершени урока', 'error');
                console.error(error);
            });
    });

    // -----------------------------------------------------------------------------------------------
    // -----------------------------------------------------------------------------------------------








    // Дебаунс функция
    function debounce(func, wait) {
        var timeout;
        return function() {
            var context = this,
                args = arguments;
            var later = function() {
                timeout = null;
                func.apply(context, args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    // Уведомление
    function showNotification(message, type) {
        // Реализуйте показ уведомления здесь
        console.log(message);
    }

  

    // Функция для отображения уведомлений
    function showNotification(message, type) {
        var notification = document.createElement('div');
        notification.className = 'notification ' + type;
        notification.textContent = message;
        document.body.appendChild(notification);

        setTimeout(function() {
            notification.classList.add('show');
            setTimeout(function() {
                notification.classList.remove('show');
                setTimeout(function() {
                    document.body.removeChild(notification);
                }, 500);
            }, 1000);
        }, 100);
    }

    // Функция debounce
    function debounce(func, wait) {
        let timeout;
        return function(...args) {
            const later = () => {
                clearTimeout(timeout);
                func.apply(this, args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }
</script>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="exampleModalLabel"> Добавление оценок</h5>
                <i type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-circle"></i></i>
            </div>
            <form>
                @csrf
                <div class="modal-body " style="font-size:11px">
                    <div class="mb-3">
                        <label for="id_user" class="form-label">Выбираете студента</label>
                        <select class="form-select form-control form-control-sm" id="id_user" name="id_user" required>
                            <option selected></option>
                            @foreach($getAllStudent as $key => $std)
                            <option value="{{$std->id}}">{{$std->name}}</option>
                            @endforeach
                        </select>
                    </div>
              
                    <!-- <div class="mb-3">
                        <label for="type_grades" class="form-label">Оценки</label>
                        <select class="form-select form-control form-control-sm" id="type_grades" name="type_grades" required>
                            <option selected></option>
                            @foreach($typeGrades as $key => $typeGrade)
                            <option value="{{$typeGrade->name}}">{{$typeGrade->name}}</option>
                            @endforeach
                        </select>
                    </div> -->
                    <div class="mb-3">
                    <!-- <label for="grades" class="form-label">Оценки</label> -->
                    <label for="grades">Введите текст (максимум 12.3 символов):</label>
                    <input type="text" oninput="checkLength(this)" name="grades" id="grades" class="form-control form-control-sm" required>
                </div>

                 
                </div>
                <div class="modal-footer" id="myTable">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <button type="button" id="submitGrades" class="btn btn-primary" data-bs-dismiss="modal">Сохранить</button>
                </div>
            </form>

        </div>
    </div>


</div>


<script type="text/javascript">

// ------------------------------------------------------------------------------------------------

    document.addEventListener('DOMContentLoaded', function() {
   
        // Добавляем обработчик для отправки формы
        document.getElementById('submitGrades').addEventListener('click', function(event) {
            var id_user = document.getElementById('id_user').value;
            var grades = document.getElementById('grades').value;

            if (!grades) { // Проверяем, заполнено ли поле оценок
                gradesInput.setCustomValidity('Это поле обязательно для заполнения');
                return;
            }

            // Отправляем данные через axios
            axios.post('/admin/addgrades', {
                    id_user: id_user,
                    grades: grades,
                })
                .then(function(response) {
                    showNotification('Оценки добавлены', 'success');
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                })
                .catch(function(error) {
                    showNotification('У студента есть оценки на эту дату', 'error');
                    console.error(error);
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                });
        });
    });
</script>

@endsection


<style>
    table,
    th,
    td {
        background-color: white
    }

    .today {
        color: white;
        background-color: #183359
    }

    th,
    td {
        padding: 5px;
        text-align: left;
    }

    th {
        /* background-color: #f0f0f0; */
    }

    .notification {
        position: fixed;
        top: 100px;
        right: 800px;
        background-color: #444;
        color: #fff;
        padding: 10px;
        border-radius: 5px;
        opacity: 1;
        transition: opacity 3.3s ease;
    }

    .notification.show {
        opacity: 1;
    }
</style>