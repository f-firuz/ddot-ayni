<?php

namespace App\Http\Controllers\admin;

use App\Facultets;
use App\Http\Controllers\Controller;

use App\TypeGrades;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class FacultetController extends Controller
{
    
    public function index()
    {

        $facultets = Facultets::get();
        

        return view('admin.facultets.index', compact('facultets'));
    }

    public function create() {
        return view('admin.facultets.create');
    }

    public function store(Request $request)
    {
        $facultet = Facultets::create($request->all());

        return redirect()->route('admin.facultets.index');
    
    }



    public function edit( Request $request,$id)
    {
        $facultets = Facultets::find($id);
        return view('admin.lessons.edit', compact('facultets'));
    }

    public function update( Request $request, $id)
    {
        $facultets = Facultets::find($id);
        $facultets->update($request->all()); 
        return redirect()->route('admin.facultets.index');
    }



    public function destroy($id)
    {

        Facultets::destroy($id);
        return redirect()->route('admin.facultets.index')->with('success', "Факультет удалена");
    }
}   