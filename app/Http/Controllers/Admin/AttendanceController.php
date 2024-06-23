<?php

namespace App\Http\Controllers\Admin;

use App\Cours;
use App\Facultets;
use App\SchoolClass;
use App\Http\Controllers\Controller;
use App\Lesson;
use App\User;
use App\TypeGrades;
use App\Subjects;
use App\Grades;
use App\Weeks;
use Carbon\Carbon;
use App\Audiences;
use App\Par;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // Загрузка уроков вместе с пользователями и их факультетами
        $resFacult = Lesson::with(['user', 'user.facultet'])->where('teacher_id', auth()->user()->id)->get();



        $facultets = Facultets::all();
        $specialty = SchoolClass::all();
        $cours = Cours::all();
        $subjects = Subjects::all();
        $weeks = Weeks::all();
        $par = Par::all();

        return view('admin.attendances.index', compact('facultets', 'specialty', 'cours', 'subjects', 'weeks', 'par'));
    }

    public function allGrates(Request $request)
    {

        Carbon::setLocale('ru');
        // Начало текущего месяца
        $startOfMonth = Carbon::now()->startOfMonth();

        // Конец текущего месяца
        $endOfMonth = Carbon::now()->endOfMonth();

        // Текущая дата для сравнения
        $today = Carbon::now()->format('d-m-Y');

        // Получаем номер текущего месяца
        $currentMonthNameLocalized = Carbon::now()->translatedFormat('F');


        $currentMonthNameLocalized = mb_convert_case($currentMonthNameLocalized, MB_CASE_TITLE, "UTF-8");
        // Инициализация массива для хранения дней месяца
        $daysOfMonth = [];
        // Цикл от начала до конца месяца
        for ($date = $startOfMonth; $date->lte($endOfMonth); $date->addDay()) {
            // Проверяем, является ли текущий день в цикле сегодняшним днем
            $isToday = $date->format('d-m-Y') === $today;

            // Добавляем день в массив, включая информацию о том, является ли он сегодняшним
            $daysOfMonth[] = array(
                'date' => $date->format('d-m'), // форматируем дату как "год-месяц-день"
                'date_rev' => $date->format('Y-m-d'), // форматируем дату как "год-месяц-день"
                'isToday' => $isToday // булево значение, указывающее, является ли день сегодняшним

            );
        }

        foreach ($daysOfMonth as $time) {


            $faculties_1 = $request->input('faculties');
            $specialty_1 = $request->input('specialty');
            $cour_1 = $request->input('cour');
            $subjects_1 = $request->input('subjects');
            // $weeks = $request->input('weekday');
            $par = $request->input('par');


            // -------------------------------------------------------------------------
            $getSubject = (string) $subjects_1;
            $getPar = (string) $par;

            // Сохраняем значение в сессию
            $request->session()->flash('getSubject', $getSubject);
            $request->session()->flash('getPar', $getPar);

            // -------------------------------------------------------------------------


            //   $ress =  [$faculties_1, $specialty_1, $cour_1, $subjects_1, $dateGrades, $isnachat_lesson] = array_values($request->only('faculties', 'specialty', 'cour', 'subjects', 'date_grades', 'nachat_lesson'));

            $getIdlesson = Lesson::where('id_faculties', $faculties_1)
                ->where('class_id', $specialty_1)
                ->where('id_subjects', $subjects_1)
                ->where('id_cours', $cour_1)
                ->where('par', $par)
                ->get();


            foreach ($getIdlesson as $getId) {
                $getIdLessonAt = $getId->id;
                if (auth()->user()->id_role == 3) {
                    Lesson::where('id', $getIdLessonAt)
                        ->where('start_lesson', false)
                        ->update(['start_lesson' => true]);

                    // Получение всех уроков, где start_lesson теперь true
                }
            }



            $getlesson = Lesson::where('id_faculties', $faculties_1)
                ->where('class_id', $specialty_1)
                ->where('id_subjects', $subjects_1)
                ->where('id_cours', $cour_1)
                ->where('par', $par)
                ->get();


            $getlessonAll = $getlesson->toArray();

            $request->session()->flash('getlessonAll', $getlessonAll);

            $listSubgect = Subjects::all();
            $typeGrades = TypeGrades::all();



            $faculForTable    = Facultets::where('id', $faculties_1)->get();
            $speciForTable    = SchoolClass::where('id', $specialty_1)->get();
            $subjectsForTable = Subjects::where('id', $subjects_1)->get();

            $faclForTableAttam = '';
            foreach ($faculForTable as $key => $faclForTable) {
                $faclForTableAttam .= $faclForTable->name;
            }

            $speciForTableAttam = '';
            foreach ($speciForTable as $key => $speciForTables) {
                $speciForTableAttam .= $speciForTables->name;
            }

            $subjectsAtt = ''; // Инициализируем $subjectsAtt перед циклом

            foreach ($subjectsForTable as $key => $subjectsForTables) {
                $subjectsAtt .= $subjectsForTables->name; // Если необходимо, добавляем значения

            }


            // dd($weeks);
            $getAllStudent = User::with(['grades' => function ($query) use ($subjects_1, $par) {
                $query->where('id_subjects', $subjects_1)
                    ->where('par', $par)
                    ->where('id_teacher', auth()->user()->id);
            }])
                ->where('id_facultet', $faculties_1) // Предполагается, что $faculties_1 определена где-то еще
                ->where('class_id', $specialty_1) // Предполагается, что $specialty_1 определена где-то еще
                ->where('id_cours', $cour_1) // Предполагается, что $cour_1 определена где-то еще
                ->get();


            return view(
                'admin.attendances.allGrates',
                compact(
                    'getAllStudent',
                    'daysOfMonth',
                    'currentMonthNameLocalized',
                    'cour_1',
                    'subjectsAtt',
                    'speciForTableAttam',
                    // 'dateGrades',
                    'listSubgect',
                    'typeGrades',
                    'faclForTableAttam',
                    'getlesson',
                    // 'weeks'
                )
            );
        }
    }


    public function store(Request $request)
    {
        // Валидация данных
        $validatedData = $request->validate([
            'id_user' => 'required|integer', // Поле id_user обязательно и должно быть целым числом
            'grades' => 'required|numeric|max:12.5', // Поле grades обязательно, числовое и должно быть не больше 12.5
        ], [
            'grades.max' => 'Оценка должна быть не больше 12.5', // Сообщение об ошибке для максимального значения
        ]);
    
        // Получаем данные из запроса
        $id_user = $validatedData['id_user'];
        $id_subject = $request->session()->get('getSubject');
        $par = $request->session()->get('getPar');
        $grades = $validatedData['grades'];
        $today = Carbon::now()->format('Y-m-d');
    
        try {
            // Проверяем, была ли уже добавлена оценка для этого студента и предмета сегодня
            $existingGrade = Grades::where('id_user', $id_user)
                                    ->where('id_subjects', $id_subject)
                                    ->whereDate('date_grades', $today)
                                    ->first();
    
            if ($existingGrade) {
                // Если уже есть оценка для этого студента, предмета и сегодняшней даты, возвращаем ошибку
                $request->session()->flash('error', 'Оценка для этого студента и предмета уже добавлена сегодня');
                return redirect()->back();
            }
    
            // Создаем новую запись в базе данных
            $grade = new Grades();
            $grade->id_user = $id_user;
            $grade->id_subjects = $id_subject;
            $grade->grades = $grades;
            $grade->par = $par;
            $grade->id_teacher = auth()->user()->id;
            $grade->date_grades = $today;
            $grade->save();
    
            // Успешный ответ
            $request->session()->flash('success', 'Оценка добавлена успешно!');
            return redirect()->route('grades.index');
        } catch (\Exception $e) {
            // Ошибка при добавлении записи
            $request->session()->flash('error', 'Ошибка при добавлении записи: ' . $e->getMessage());
            return redirect()->back();
        }
    }
    
    

    



    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }

    public function create(Request $request)
    {
     
    }
    public function update(Request $request)
    {
        // Получаем данные из запроса
        $id = $request->input('id');
        $value = $request->input('value');

        // Обновляем запись в базе данных
        $grade = Grades::find($id);
        if ($grade) {
            $grade->grades = $value;
            $grade->save();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'error' => 'Grade not found'], 404);
        }
    }

    public function destroy($id)
    {
        //
    }


    public function stopLesson(Request $request)
    {

        // Получаем $studentsArray из флеш-сообщения
        $getlessonAll = $request->session()->get('getlessonAll');

        // Проверяем, получены ли данные
        if ($getlessonAll) {
            // Если да, то делаем с ними что-то
            foreach ($getlessonAll as $res) {
             
                if (auth()->user()->role_id = 3) {
                    Lesson::where('id', $res['id'])->where('start_lesson', true)->update(['start_lesson' => false]);
                }
            }
        } else {
            // Если нет, выводим сообщение об ошибке
            return back()->with('error', 'Данные не найдены');
        }


        return back()->with('success', 'Данные успешно сохранены');
    }

    public function stopLessonAll(Request $request)
    {

        // Получаем $studentsArray из флеш-сообщения
        $getlessonAll = $request->session()->get('getlessonAll');

        // Проверяем, получены ли данные
        if ($getlessonAll) {
            // Если да, то делаем с ними что-то
            foreach ($getlessonAll as $res) {
                Lesson::where('id', $res['id'])->where('start_lesson', true)->update(['start_lesson' => false]);
            }
        } else {
            // Если нет, выводим сообщение об ошибке
            return back()->with('error', 'Данные не найдены');
        }


        return back()->with('success', 'Данные успешно сохранены');
    }
}
