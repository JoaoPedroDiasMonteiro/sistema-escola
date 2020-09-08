<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;

    public function schedule()
    {
       return $this->hasMany(Schedule::class, 'student');
    }

    /**
     * Delete the model from the database.
     *
     * @return bool|null
     *
     * @throws \Exception
     */
    public function delete()
    {
        $schedules = Schedule::query()->where('student', '=', $this->id)->get();

        foreach ($schedules as $schedule){
            $schedule->delete();
        }

        return parent::delete();
    }
}
