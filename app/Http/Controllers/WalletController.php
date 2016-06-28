<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Interfaces\Calendar;

class WalletController extends Controller implements Calendar
{

    public $weekdays = ['<span style="color: red">日</span>', "月", "火", '水', '木', '金', '<span style="color: blue">土</span>'];

    public $year;//2016
    public $month;//06
    public $lastday;//29 || 30 || 31

    public $lastdate;//'Y-m-d'
    public $firstdate;//'Y-m-01'

    public $sundays;//[$day]
    public $saturdays;//[$day]

    public $month_tasks;//['Y-m-d'=>[$day_task1,$day_task2]]

    public $weeks = [];//[[$day],[$day]];ex.[['',1,2,3],[4,5,6,7,8,9,10],...]
    public $sunday_color = 'red';
    public $saturday_color = 'blue';

    public function __construct()
    {

        $this->generateCalendar(request('year'), request('month'));
//        dd(get_object_vars($this));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
//        return get_object_vars($this);
        return $this->calendar_table('table table-bordered');
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
    }

    public function calendar_table($class = null)
    {
        return
            "<table class='$class'>" .
            $this->calendar_table_weekdays_row() .
            $this->calendar_table_weeks_rows() .
            "</table>";
    }


    public function calendar_table_weeks_rows()
    {
        return view('layouts.calendar.weeks', ['weeks' => $this->weeks])->render();
    }


    function generateCalendar($year = null, $month = null)
    {

        $this->year = $year ?? date('Y');
        $this->month = $month ?? date('m');

        $this->lastday = date('j', mktime(0, 0, 0, $this->month + 1, 0, $this->year));

        $week = 0;

        for ($day = 1; $day <= $this->lastday; $day++) {
            $date = mktime(0, 0, 0, $month, $day, $year);
            $wd = date('w', $date);//0:Sunday,6:Saturday

            if ($day == 1) {
                for ($i = 0; $i < $wd; $i++) {
                    $this->weeks[$week][] = '&nbsp;';
                }
            }

            $this->weeks[$week][] = $day;

            if ($wd == 0) {
                $this->sundays[] = $day;
            } elseif ($wd == 6) {
                $this->saturdays[] = $day;
                ++$week;
            }

            if ($day == $this->lastday) {
                for ($i = $wd + 1; $i <= 6; $i++) {
                    $this->weeks[$week][] = '&nbsp;';
                }
            }

        }

        $this->firstdate = $this->year . '-' . $this->month . '-01';
        $this->lastdate = $this->year . '-' . $this->month . '-' . $this->lastday;


    }

    public function calendar_table_weekdays_row()
    {
        return view('layouts.calendar.tr_head_row', ['wdays' => $this->weekdays])->render();
    }


    public function isSunday($day)
    {
        return in_array($day, $this->sundays);
    }

    public function isSaturday($day)
    {
        return in_array($day, $this->saturdays);
    }

    public function dayTd($day, $data = [], $options = [])
    {
        if ($this->isSunday($day)) {
            $options = array_merge($options, ['style' => 'color:' . $this->sunday_color]);
        } elseif ($this->isSaturday($day)) {
            $options = array_merge($options, ['style' => 'color:' . $this->sunday_color]);
        }

        return view('layouts.calendar.tr_td', compact('day', 'data', 'options'))->render();
    }

    public function sundayTd($data, $options = [])
    {

        return view('layouts.calendar.tr_td', compact('data', 'options'))->render();
    }

    public function saturdayTd($data, $options = [])
    {

        return view('layouts.calendar.tr_td', compact('data', 'options'))->render();

    }

    public function normaldayTd($data, $options = [])
    {
        return view('layouts.calendar.tr_td', compact('data', 'options'))->render();

    }

    function tr_td_add_button($button_template = null, $options = null)
    {
        return view($button_template ?? 'layouts.calendar.tr_td_add_button', compact($options))->render();
    }

    function tr_td_data_list($data_template = null, $options = null)
    {
        return view($button_template ?? 'layouts.calendar.tr_td_data_list', compact($options))->render();
    }

}
