<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lection extends Model
{
    use HasFactory;

    protected $fillable = [
        'topic'
    ];

    public $timestamps = false;

    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class)->withPivot('order')->orderBy('pivot_order');
    }
}
