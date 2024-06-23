<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grades extends Model {
    use HasFactory;
    protected $table = 'grades';

    protected $fillable = [
        'faculties',
        'specialty',
        'cours',
        'subjects',
        'grates',
        'par',
        'auditor',
        'teacher',
        'date_grates',
        'created_at',
        'updated_at',
        'deleted_at',
        'id_user',
    ];

    public function student() {
        return $this->belongsTo( User::class, 'id_user' );
    }

    public function facultet() {
        return $this->belongsTo( Facultets::class, 'id_facultet' );
    }

    public function subjects() {
        return $this->belongsTo( Subjects::class, 'id_subjects' );
    }
    // public function date_grades()
    // {
    //     return $this->belongsTo( Grades::class, 'date_grades' );
    // }

    public function dategrades() {
        return $this->belongsTo( Grades::class, 'date_grades' );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}
