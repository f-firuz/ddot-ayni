<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Par extends Model
{
    use HasFactory;
    public $table = 'par';


    protected $fillable = [
        'id'
    ];
}
