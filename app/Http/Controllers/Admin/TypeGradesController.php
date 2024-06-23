<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\TypeGrades;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class TypeGradesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('type_grades_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $typegrades = TypeGrades::get();
        

        return view('admin.type-grades.index', compact('typegrades'));
    }



    public function create()
    {
        return view('admin.type-grades.create');
    }

    public function store(Request $request)
    {

         $typegrades = TypeGrades::create($request->all());
        return redirect()->route('admin.type-grades.index');
    
    }

    public function destroy($id)
    {
        $res= TypeGrades::destroy($id);
      
        return redirect()->route('admin.type-grades.index')->with('success', "Успешно удалена");
    }

}
