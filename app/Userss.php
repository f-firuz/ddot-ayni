<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Userss extends Model
{
    use HasFactory;
    public $table = 'events';

    // protected $fillable = [
    //     'name', 'email',
    // ];
    protected $fillable = ['title', 'day', 'time'];
}
