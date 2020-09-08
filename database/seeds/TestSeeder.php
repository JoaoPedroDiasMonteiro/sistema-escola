<?php

use App\Registry;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teachers = factory(\App\Teacher::class, 10)->make()->toArray();

        foreach ($teachers as $teacher) {
            $students = factory(\App\Student::class, 130)->make()->toArray();
            $teacher = \App\Teacher::create($teacher);

            foreach ($students as $student) {
                $student = \App\Student::create($student);
                $weekday = factory(\App\Schedule::class, 1)->make();

                $schedule = new \App\Schedule();
                $schedule->teacher = $teacher->id;
                $schedule->student = $student->id;
                $schedule->weekday = $weekday[0]['weekday'];
                $schedule->hour = $weekday[0]['hour'] . ':00:00';
                $schedule->save();
            }
        }

        $registry = new Registry();
        $registry->run();
    }
}
