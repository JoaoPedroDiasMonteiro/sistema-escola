<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registry extends Model
{

    public function schedule()
    {
        return $this->hasMany(Schedule::class, 'schedule', 'id');
    }

    public function unrealized()
    {
        return $unrealized = Registry::query()->where('status', '=', null)
            ->where('date', '<', date('Y-m-d H:m:i'))->get();
    }

    public function run(int $afterWeeks = 2): void
    {
        $start = new \DateTime();
        $end = new \DateTime("{$afterWeeks}weeks");
        $interval = new \DateInterval('PT1H');
        $period = new \DatePeriod($start, $interval, $end);

        foreach ($period as $date) {
            $weekday = $date->format('l');
            $hour = $date->format('H') . ':00:00';
            $date = $date->format('Y-m-d') . " {$hour}";

            $schedules = Schedule::query()->where('weekday', '=', $weekday)
                ->where('hour', '=', $hour)->get();

            if ($schedules->count()) {

                foreach ($schedules as $schedule) {
                    if (Registry::query()->where('date', '=', $date)->where('schedule', '=',
                        $schedule->id)->get()->count()) {
                        continue;
                    }

                    $registry = new Registry();
                    $registry->schedule = $schedule->id;
                    $registry->date = $date;
                    $registry->save();
                }
            }
        }
    }
}
