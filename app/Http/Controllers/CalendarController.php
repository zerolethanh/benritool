<?php

namespace App\Http\Controllers;

use App\Schedule;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class CalendarController extends Controller
{
    use SoftDeletes;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
         * weeks
         */
        $weekdays = ['<span style="color: red">日</span>', "月", "火", '水', '木', '金', '<span style="color: blue">土</span>'];
        $cal = $this->cal(request('year'), request('month'));

        $year = $cal['year'];
        $month = $cal['month'];

        $weeks = $cal['weeks'];

        $sundays = $cal['sundays'];
        $saturdays = $cal['saturdays'];

        /*
         * next month, prev month
         */
        $firstdatetime = strtotime($cal['firstdate']);
        $nextmonth = date('\?\y\e\a\r\=Y\&\m\o\n\t\h\=m', strtotime('+1 month', $firstdatetime));
        $prevmonth = date('\?\y\e\a\r\=Y\&\m\o\n\t\h\=m', strtotime('-1 month', $firstdatetime));

//        return $cal;
        /*
         * schedules
         */
        $schedules = Schedule::where('user_id', Auth::id())
            ->where('date', '>=', $cal['firstdate'])
            ->where('date', '<=', $cal['lastdate'])
            ->orderBy('date')
            ->get();

        foreach ($schedules as $sh) {
            $sh['start'] = substr($sh['start'], 0, 5);
            $sh['end'] = substr($sh['end'], 0, 5);
            $sh['linkcontent'] = view('calendar.index.linkcontent', $sh->toArray())->render();

        }

        $schedules = $schedules->groupBy('date');

//        dd($schedules);
        return view('calendar.index', compact('weekdays', 'weeks', 'year', 'month', 'schedules', 'sundays', 'saturdays',
            'nextmonth', 'prevmonth'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $new_schedule = Schedule::create($this->storeData($request));
//        return $data;

        return $new_schedule;
    }

    public function storeData(Request $request)
    {
        $this->validate($request, ['start' => 'required', 'end' => 'required', 'schedule' => 'required', 'date' => 'required']);

        $data = $request->only(['schedule', 'date', 'start', 'end', 'description']);
        if ($user = $request->user()) {
            $data['user_id'] = $user->id;
        }
        return $data;

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $schedule = Schedule::findOrFail($id);
        $schedule['start'] = substr($schedule['start'], 0, 5);
        $schedule['end'] = substr($schedule['end'], 0, 5);
        return $schedule;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $schedule = Schedule::findOrFail($id)
            ->fill($request->all())
            ->save();
        return $schedule;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $deleted = Schedule::findOrFail($id)->delete();
        return compact('deleted');
    }

    function cal($year = null, $month = null)
    {

        $year = $year ?? date('Y');
        $month = $month ?? date('m');

        $lastday = date('j', mktime(0, 0, 0, $month + 1, 0, $year));


        $weeks = [];
        $week = 0;
        $sundays = [];
        $saturdays = [];

        for ($day = 1; $day <= $lastday; $day++) {
            $date = mktime(0, 0, 0, $month, $day, $year);
            $wd = date('w', $date);//0:Sunday,6:Saturday

            if ($day == 1) {
                for ($i = 0; $i < $wd; $i++) {
                    $weeks[$week][] = "";
                }
            }

            $weeks[$week][] = $day;
            if ($wd == 0) {
                $sundays[] = $day;
            } elseif ($wd == 6) {
                $saturdays[] = $day;
            }

            if ($day == $lastday) {
                for ($i = $wd; $i < 6; $i++) {
                    $weeks[$week][] = "";
                }
            }

            if ($wd == 6) {
                ++$week;
            }

        }

        $firstdate = "$year-$month-01";
        $lastdate = "$year-$month-$lastday";

        $res = compact('weeks', 'year', 'month', 'firstdate', 'lastdate', 'sundays', 'saturdays');

        return $res;
    }
}
