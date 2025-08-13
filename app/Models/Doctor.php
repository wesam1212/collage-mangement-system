<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = ['name','email','salary','age','gender','department_id'];

    // علاقة الدكتور مع الطلاب (دكتور له طلاب)
    public function students()
    {
        return $this->hasMany(Student::class);
    }

    // علاقة الدكتور مع الكورسات
    // ملاحظة: حسب الكود السابق العلاقة كانت many-to-many (sync, detach تستخدم مع علاقة many-to-many)
    // هنا الأصلية لديك hasMany، لكن إذا كانت العلاقة many-to-many فغيرها إلى belongsToMany
   public function courses()
{
    return $this->belongsToMany(Course::class);
}

    // علاقة الدكتور مع القسم
public function department()
{
    return $this->belongsTo(Department::class);
}

}
