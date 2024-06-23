<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class CountHomePage extends Controller
{
    public function count()
    {
        $data = [];
        $data['userContetnt'] = User::all()->count();
        return view('home.index', compact('data'));
    }
}
