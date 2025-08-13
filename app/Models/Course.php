<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['title','description','credit_hours','doctor_id','department_id'];

   // في موديل Course.php
// App\Models\Course.php

public function doctors()
{
    return $this->belongsToMany(Doctor::class);
}


    public function department()
    {
        return $this->belongsTo(Department::class)->withDefault([
            'name' => 'Department not found',
        ]);
    }
}
