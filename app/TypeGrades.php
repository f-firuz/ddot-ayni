<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeGrades extends Model
{
    use HasFactory;
    protected $table = 'type_grades';
    
    protected $fillable = [
        'name',
    ];
 

}
