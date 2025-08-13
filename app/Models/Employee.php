<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    // الحقول المسموح بالتحديث الجماعي
    protected $fillable = ['name', 'email', 'position', 'age', 'gender', 'salary']; // مثال

}
