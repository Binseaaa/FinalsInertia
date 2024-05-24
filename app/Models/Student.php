<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'department', 'status'];

    protected static function boot()
    {
        parent::boot();

        // Generate id_num before creating a new student
        static::creating(function ($student) {
            $student->id_num = strtoupper(\Str::random(2) . \Str::random(9) . \Str::random(2));
        });
    }
}
