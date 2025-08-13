<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'age',
        'gender',
        'email',
        'department_id',
        'doctor_id',
    ];

    // علاقة الطالب بالكورسات (Many-to-Many)
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_student', 'student_id', 'course_id');
    }

    // علاقة الطالب بالقسم (Many-to-One)
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    // علاقة الطالب بالدكتور (Many-to-One)
    public function doctor()
    {
        return $this->belongsTo(Doctor::class)->withDefault([
            'name' => 'Doctor not found',
        ]);
    }
}
