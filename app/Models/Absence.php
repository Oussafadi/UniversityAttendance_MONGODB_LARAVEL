<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;
use App\Models\Student;

class Absence extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'absences';

    //protected $guarded = [];


    public function student()
    {
        return Student::where('admissionNumber', $this->getAttribute('admissionNo'))->first();
    }
}
