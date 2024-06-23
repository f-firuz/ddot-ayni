<?php

namespace App\Http\Controllers\Admin;

use App\Facultets;
use App\Audiences;
use App\Subjects;
use App\Weeks;
use App\Cours;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyLessonRequest;
use App\Http\Requests\StoreLessonRequest;
use App\Http\Requests\UpdateLessonRequest;
use App\Lesson;
use App\Par;
use App\SchoolClass;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LessonsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('lesson_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lessons = Lesson::all();

        return view('admin.lessons.index', compact('lessons'));
    }

    public function create()
    {
        abort_if(Gate::denies('lesson_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $classes = SchoolClass::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $facultets = Facultets::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $subjects = Subjects::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $cours = Cours::all()->pluck('cours', 'id')->prepend(trans('global.pleaseSelect'), '');
        $audit = Audiences::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $weeks = Weeks::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $par = Par::all()->pluck('id')->prepend(trans('global.pleaseSelect'), '');
        $teachers = User::all()->where('id_role', 3)->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        return view('admin.lessons.create', compact('facultets', 'teachers','classes','subjects','audit','weeks','cours','par'));
    }

    public function store(StoreLessonRequest $request)
    {
        $lesson = Lesson::create($request->all());

        return redirect()->route('admin.lessons.index');
    }

    public function edit(Lesson $lesson)
    {
        abort_if(Gate::denies('lesson_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $classes = SchoolClass::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $teachers = User::all()->where('id_role', 3)->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lesson->load('class', 'teacher');

        return view('admin.lessons.edit', compact('classes', 'teachers', 'lesson'));
    }

    // public function update(UpdateLessonRequest $request, Lesson $lesson)
    public function update(Request $request, $id)
    {
        // $lesson->update($request->all());
        $request->validate([
            'par' => 'required|string|max:255',
            // 'auditor' => 'required|string|max:255',
            // 'teacher_name' => 'required|string|max:255',
        ]);
    
        $event = Lesson::findOrFail($id);
        $event->par = $request->par;
        // $event->auditor = $request->auditor;
        // $event->teacher_name = $request->teacher_name;
        $event->save();
    
        return response()->json(['success' => true]);

        // return redirect()->route('admin.lessons.index');
    }

    public function show(Lesson $lesson)
    {
        abort_if(Gate::denies('lesson_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lesson->load('class', 'teacher');

        return view('admin.lessons.show', compact('lesson'));
    }

    public function destroy(Lesson $lesson)
    {
        abort_if(Gate::denies('lesson_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lesson->delete();

        return back();
    }

    public function massDestroy(MassDestroyLessonRequest $request)
    {
        Lesson::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

}

