<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{

    use SoftDeletes;

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student');
    }

    public function registry()
    {
        return $this->belongsToMany(Registry::class, '', '', '');
    }

    public function save(array $options = [])
    {
        $teacherCheck = Schedule::query()->where('teacher', '=', $this->teacher)
            ->where('weekday', '=', $this->weekday)
            ->where('id', '!=', $this->id)
            ->where('hour', '=', $this->hour)->get()->count();

        $studentCheck = Schedule::query()->where('student', '=', $this->student)
            ->where('weekday', '=', $this->weekday)
            ->where('id', '!=', $this->id)
            ->where('hour', '=', $this->hour)->get()->count();

        if ($teacherCheck || $studentCheck) {
            echo "It's not possible to save two students or teachers at same time!";
            return false;
        }

        $this->hour = date('H', strtotime($this->hour)) . ':00:00';

        $weekdays = [
            'Sunday',
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday',
        ];

        if (!in_array($this->weekday, $weekdays)){
            return false;
        }
        return parent::save($options);
    }
}
