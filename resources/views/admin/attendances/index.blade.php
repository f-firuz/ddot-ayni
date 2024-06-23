@extends('layouts.admin')
@section('content')
<div class="content">

    <div class=" shadow p-3 " style="background-color: white">
    <div class="card-header pb-3" style="color: #ff6a00; font-weight: bold ; background-color:white;" >
            Журналь группы  
        </div> 
           
    <form class="row gx-3 gy-1 align-items-center pb-2" method="POST" action="{{ route("admin.allgrates.index") }}" enctype="multipart/form-data">
            @csrf
            <div class="col-sm-3">
                <label class="visually-hidden" for="faculties">Факультеты</label>
                <select class="form-select form-control {{ $errors->has('name') ? 'is-invalid' : '' }} " id="faculties" name="faculties" required>
                    <option selected></option>
                    @foreach($facultets as $key => $cour)
                    <option value="{{$cour->id}} ">{{$cour->name}}</option>
                    @endforeach
                </select>
                @if($errors->has('name'))
                <div class="invalid-feedback">
                    {{ $errors->first('name') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>

            </div>
            <div class="col-sm-2">
                <label class="visually-hidden" for="specialty">Специальносты</label>
                <select class="form-select form-control" id="specialty" name="specialty" required>
                    <option selected></option>
                    @foreach($specialty as $key => $spec)
                    <option value="{{$spec->id }}">{{$spec->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-1">
                <label class="visually-hidden" for="cour">Курсы</label>
                <select class="form-select form-control" id="cour" name="cour" required>
                    <option selected></option>
                    @foreach($cours as $key => $cour)
                    <option value="{{$cour->id}}">{{$cour->cours}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-sm-1">
                <label class="visually-hidden" for="subjects">Предметы</label>
                <select class="form-select form-control" id="subjects" name="subjects" required>
                    <option selected></option>
                    @foreach($subjects as $key => $cour)
                    <option value="{{$cour->id}}">{{$cour->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-1">
                <label class="visually-hidden" for="subjects">Недели</label>
                <select class="form-select form-control" id="weekday" name="weekday" required>
                    <option selected></option>
                    @foreach($weeks as $key => $cour)
                    <option value="{{$cour->id}}">{{$cour->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-1">
                <label class="visually-hidden" for="subjects">Пары</label>
                <select class="form-select form-control" id="par" name="par" required>
                    <option selected></option>
                    @foreach($par as $key => $pars)
                    <option value="{{$pars->id}}">{{$pars->id}}</option>
                    @endforeach
                </select>
            </div>
            <!-- Время начала -->

            <!-- <div class="col-sm-1">
                <label class="required" for="start_time">{{ trans('cruds.lesson.fields.start_time') }}</label>
                <input class="form-control lesson-timepicker {{ $errors->has('start_time') ? 'is-invalid' : '' }}"
                       type="text" name="start_time" id="start_time" value="{{ old('start_time') }}" required>
                @if($errors->has('start_time'))
                    <div class="invalid-feedback">
                        {{ $errors->first('start_time') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lesson.fields.start_time_helper') }}</span>
            </div> -->
            <!-- Время окончания -->
            <!-- <div class="col-sm-2">
                <label class="required" for="end_time">{{ trans('cruds.lesson.fields.end_time') }}</label>
                <input class="form-control lesson-timepicker {{ $errors->has('end_time') ? 'is-invalid' : '' }}"
                       type="text" name="end_time" id="end_time" value="{{ old('end_time') }}" style="width: 119px;" required>
                @if($errors->has('end_time'))
                    <div class="invalid-feedback">
                        {{ $errors->first('end_time') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lesson.fields.end_time_helper') }}</span>
            </div> -->
            <div class="col-sm-1 mt-2">
                <label class="visually-hidden">Начала урока</label>
                <input type="checkbox" checked class="" name="nachat_lesson" id="nachat_lesson">
            </div>

            <div class="col-auto mt-1 float-right ">
                <button type="submit" class="btn text-white " disabled  style="background-color:#f59128" >Начать урока</button>
            </div>

        </form>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkBox = document.getElementById('nachat_lesson');
        const checkbox = document.getElementById('nachat_lesson');
        // Установка чекбокса в неотмеченное состояние
        checkbox.checked = false;
        const searchButton = document.querySelector('.text-white');

        // Инициализация состояния кнопки на основе состояния чекбокса
        searchButton.disabled = !checkBox.checked;

        // Добавление обработчика событий на чекбокс
        checkBox.addEventListener('change', function() {
            searchButton.disabled = !this.checked;
        });
    });
</script>

<!-- <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
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
                showNotification('Ошибка завершени урока', 'error');
                console.error(error);
            });
    }); -->

@endsection

<style>
    form {
        font-size: 0.8em;
        padding: 10px;
    }
    form select  option{
        font-size: 0.8em;
    }
</style>