<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public $timestamps = false;

    public function lections()
    {
        return $this->belongsToMany(Lection::class, 'classroom_lection')
            ->withPivot('order')
            ->orderBy('classroom_lection.order');
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
