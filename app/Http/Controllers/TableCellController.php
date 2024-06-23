<?php

namespace App\Http\Controllers;

use App\Lesson;
use App\TableCell;
use App\Userss;
use Illuminate\Http\Request;

class TableCellController extends Controller
{
    public function index()
    {
        $eve = Userss::get();
        return view('table', compact('eve'));
    }

    public function update(Request $request, $id)
    {
        $tableCell = TableCell::findOrFail($id);
        $tableCell->text = $request->text;
        $tableCell->save();
        return response()->json(['success' => true]);
    }


    public function store(Request $request)
    {
        // // Валидация и сохранение события в базе данных
        // $validated = $request->validate([
        //     'title' => 'required|string|max:255',
        //     'day' => 'required|integer',
        //     'hour' => 'required',
        // ]);

        // Сохранение события в базе данных
         Userss::create();

        //  $res = Lesson::create($request->all());


        return response()->json(['success' => true]);
    }
}