<?php
namespace App\Http\Controllers\admin;

use App\Cours;
use App\Facultets;
use App\Http\Controllers\Controller;
use App\Lesson;
use App\Grades;
use App\SchoolClass;
use App\Services\AllFacultetsService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class AllFacultetsController extends Controller {

    protected $allFacultetsService;

    public function __construct( AllFacultetsService $allFacultetsService ) {
        $this->allFacultetsService = $allFacultetsService;
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index( AllFacultetsService $calendarService ) {

        $specialtys    = SchoolClass::all();
        $facultets     = Facultets::all();
        $cours         = Cours::all();

        return view( 'admin.indexAllFacultets', compact( 'specialtys', 'facultets', 'cours' ) );

    }

    public function store( AllFacultetsService $calendarService, Request $request ) {
        // Создаем объект Carbon для текущей даты
        $currentDate = Carbon::now();

        // Получаем номер дня недели ( 0 - воскресенье, 1 - понедельник, и т.д. )
        $dayOfWeek = $currentDate->dayOfWeek;

        // Определяем названия дней недели на русском языке
        $daysOfWeekRussian = [
            'воскресенье',
            'понедельник',
            'вторник',
            'среда',
            'четверг',
            'пятница',
            'суббота'
        ];

        // Получаем название дня недели на русском языке
        $russianDayOfWeek = $daysOfWeekRussian[ $dayOfWeek ];
        $nedeli = Str::ucfirst( $russianDayOfWeek );

        $weekDays     = Lesson::WEEK_DAYS;

        $getspecialtys = $request->input( 'specialty' );
        $getfacultets = $request->input( 'faculties' );
        $getcours = $request->input( 'cours' );

        $res = Facultets::pluck( 'id' );
        // Получаем массив идентификаторов из столбца 'id'
        $specialtys = SchoolClass::whereIn( 'id_faculties', $res )->where( 'id_faculties', $getfacultets )->get();
        // Используем метод whereIn для фильтрации по массиву идентификаторов
        $facultForTable = Facultets::where( 'id', $getfacultets )->get();
        //    Цикл для получения имя Факультета
        $resfacultForTable = '';
        // Определение переменной до начала цикла
        foreach ( $facultForTable as $key => $fac ) {
            $resfacultForTable = $fac->name;
        }

        // Создание экземпляра Carbon с текущей датой и временем
        $minutes = Carbon::now();

        //        $calendarData = $this->allFacultetsService->generateCalendarData( $request, $weekDays );
        $calendarData = $this->allFacultetsService->generateCalendarData( $request, $weekDays, $specialtys );

        
        $qrCode = QrCode::size(30)->generate('https://example.com1');
        session('qrCode');    
        
        return view( 'admin.calendarAllFacultets',  compact( 'weekDays', 'getcours',
        'getspecialtys', 'getfacultets', 'calendarData', 'specialtys', 'resfacultForTable', 'nedeli', 'minutes', 'qrCode' ) );
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function edit( $id ) {
        //
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function update( Request $request, $id ) {
        //
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function destroy( $id ) {
        //
    }




    public function updatePosition(Request $request)
    {
        try {
            $id = $request->input('id');
            $oldPosition = $request->input('oldPosition');
            $newPosition = $request->input('newPosition');
    
            // Логика обновления базы данных в зависимости от вашей структуры данных
            $record = Lesson::find($id);
            
            if (!$record) {
                return response()->json(['status' => 'error', 'message' => 'Record not found'], 404);
            }
    
            // Предполагаем, что в вашей модели есть поле position
            $record->position = $newPosition;
            $record->save();
    
            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            // Логируем ошибку
            \Log::error('Error updating position: '.$e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Internal Server Error'], 500);
        }
    }


    public function updateCell(Request $request)
    {
        // Получаем данные о перемещении ячеек из запроса
        $sourceId = $request->input('source_id');
        $targetId = $request->input('target_id');

        // Обновляем записи в базе данных на основе полученных данных
        // Напишите свой код здесь для обновления данных в базе данных

        // Возвращаем ответ клиенту
        return response()->json(['message' => 'Move from cell ' . $sourceId . ' to cell ' . $targetId . ' was saved in the database.']);
    }

}

