<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facultets extends Model
{
    
    use HasFactory;
    protected $table = 'facultets';
    


    protected $fillable = [
        'name',
    ];

    function grades()
    {
        return $this->hasMany(Grades::class, 'id_user');
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'id_faculties');
    }
    // function facultet()
    // {
    //     return $this->hasMany(Facultets::class, 'id_faculties');
    // }

    public function facultetUsers(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(User::class, 'id_facultet', 'id');
    }


    
}
