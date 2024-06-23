<?php

namespace App\Services;

use App\Lesson;
use Illuminate\Http\Request;

class AllFacultetsService
{
    public function generateCalendarData(Request $request, $weekDays, $specialtys)
    {
        $id_faculties = $request->input('faculties');
        $id_cours = $request->input('cours');

        $calendarDatas = [];
        $timeRange = (new TimeService)->generateTimeRange(config('app.calendar.start_time'), config('app.calendar.end_time'));
        $lessons = Lesson::with('class', 'teacher', 'subjects', 'audiences')
            ->calendarByRoleOrClassId()
            ->get();
            // dd($timeRange);
        foreach ($specialtys as $spec) {
            $calendarData = [];
            foreach ($timeRange as $key => $time) {
                $timeText = $time['start'] . ' - ' . $time['end'];
                $calendarData[$timeText] = [];

                foreach ($weekDays as $index => $day) {
                    $lesson = $lessons->where('weekday', $index)
                        ->where('id_faculties', $id_faculties)
                        ->where('id_cours', $id_cours)
                        ->where('start_time', $time['start'])
                        ->where('end_time', $time['end'])
                        ->first();
                        
                 

                    if ($lesson) {
                        array_push($calendarData[$timeText], [
                            'id'        =>  $lesson->id,
                            'class_name' => $lesson->class['name'] ?? '',
                            'teacher_name' => $lesson->teacher['name'] ?? '',
                            'subject_name' => $lesson->subjects['name'] ?? '',
                            'auditor' => $lesson->audiences['name'] ?? '',
                            'facultet' => $lesson->facultet['id'] ?? '',
                            'live'         => $lesson->start_lesson ?? '',
                            'par'         => $lesson->par ?? '',
                            'rowspan' => $lesson->difference / 60 ?? ''
                        ]);
                    } else if (!$lessons->where('weekday', $index)->where('start_time', '<', $time['start'])->where('end_time', '>=', $time['end'])->count()) {
                        array_push($calendarData[$timeText], 1);
                    } else {
                        array_push($calendarData[$timeText], 0);
                    }

                }
            }
            $calendarDatas[$spec->id] = $calendarData;
        }
       
        return $calendarDatas;
    }
}
