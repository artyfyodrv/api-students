<?php

namespace App\Models;

use App\Http\Controllers\StudentController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lection extends Model
{
    use HasFactory;

    protected $fillable = [
        'topic',
        'description'
    ];

    public $timestamps = false;

    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class, 'classroom_lection')
            ->withPivot('order')
            ->orderBy('classroom_lection.order');
    }

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }
}
