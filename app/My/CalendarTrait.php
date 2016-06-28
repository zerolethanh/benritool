<?php
/**
 * Created by PhpStorm.
 * User: ZE
 * Date: 2016/06/22
 * Time: 13:38
 */
namespace App\My;

use Faker\Provider\Uuid;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

trait CalendarTrait
{
    public $today_date, $date, $first_date, $last_date, $last_day;

    public $date_format = 'Y-m-d';

    public $year, $month, $day;
    public $weeks = [];
    public $sundays = array(), $saturdays = array();
    public $prev_month, $next_month;

    protected $year_keys = ['year', 'y'];
    protected $month_keys = ['month', 'm'];
    protected $day_keys = ['day', 'd'];
    protected $date_format_keys = ['dateformat', 'df'];
    protected $sarturday_color = 'blue', $sunday_color = 'red', $workday_color = 'black';
    protected $weekdays = ['<span style="color: red">日</span>', "月", "火", '水', '木', '金', '<span style="color: blue">土</span>'];

    public $contents = array(), $sql, $contents_by_date;

    public function __construct()
    {
        $request_all = array_change_key_case(request()->all(), CASE_LOWER);
//        dd($request_all);
        /*
         * Year month day　を取得
         */
        foreach ($this->date_format_keys as $date_format_key) {
            if (array_key_exists($date_format_key, $request_all)) {
                $this->date_format = $request_all[$date_format_key];
                break;
            }
        }

        foreach ($this->year_keys as $request_year_key) {
            if (isset($request_all[$request_year_key]) && is_numeric($request_all[$request_year_key])) {
                $this->year = $request_all[$request_year_key];
                break;
            } else $this->year = date('Y');
        }


        foreach ($this->month_keys as $request_month_key) {

            if (isset($request_all[$request_month_key]) && is_numeric($request_all[$request_month_key])) {
                $this->month = $request_all[$request_month_key];
                break;
            } else $this->month = date('m');

        }
        foreach ($this->day_keys as $request_day_key) {
            if (array_key_exists($request_day_key, $request_all) && is_numeric($request_all[$request_day_key])) {
                $this->day = $request_all[$request_day_key];
                break;
            } else $this->day = date('d');
        }

        $this->today_date = date($this->date_format);
        $this->date = date($this->date_format, mktime(0, 0, 0, $this->month, $this->day, $this->year));
        $this->first_date = date($this->date_format, mktime(0, 0, 0, $this->month, 1, $this->year));
        $this->last_date = date($this->date_format, mktime(0, 0, 0, $this->month + 1, 0, $this->year));
        $this->last_day = date('j', mktime(0, 0, 0, $this->month + 1, 0, $this->year));

        /*
        * next month, prev month
        */
        $firstdatetime = strtotime($this->first_date);
        $this->next_month = date('\?\y\e\a\r\=Y\&\m\o\n\t\h\=m', strtotime('+1 month', $firstdatetime));
        $this->prev_month = date('\?\y\e\a\r\=Y\&\m\o\n\t\h\=m', strtotime('-1 month', $firstdatetime));
//        dd($this->prev_month);
        $this->cal();
        $this->contents();

    }

    function cal()
    {
        $week = 0;
        for ($day = 1; $day <= $this->last_day; $day++) {
            $date = mktime(0, 0, 0, $this->month, $day, $this->year);
            $wd = date('w', $date);//0:Sunday,6:Saturday

            if ($day == 1) {
                for ($i = 0; $i < $wd; $i++) {
                    $this->weeks[$week][$i . '.' . str_random()] = null;
                }
            }

            $this->weeks[$week][$wd . '.' . $day] = date($this->date_format, mktime(0, 0, 0, $this->month, $day, $this->year));

            if ($wd == 0) {
                $this->sundays[] = $day;
            } elseif ($wd == 6) {
                $this->saturdays[] = $day;
            }

            if ($day == $this->last_day) {
                for ($i = $wd; $i < 6; $i++) {
                    $this->weeks[$week][$i . '.' . str_random()] = null;
                }
            }

            if ($wd == 6) {
                ++$week;
            }
        }

    }

    function contents()
    {
        $model = $this->model();
        $date_field = $this->date_field();

        $this->contents = $model::where('user_id', Auth::id())
            ->where($date_field, '>=', $this->first_date)
            ->where($date_field, '<=', $this->last_date)
            ->orderBy($date_field)
            ->get();
        $this->contents_by_date = collect($this->contents)->groupBy($date_field)->toArray();

        foreach ($this->weeks as &$week) {
            foreach ($week as $wd_day => &$date) {
                if (array_key_exists($date, $this->contents_by_date)) {
                    $date = $this->contents_by_date[$date];
                }// else $date = null;
            }
        }

//        return $this->weeks;
    }


    abstract function model();

    abstract function date_field();

}
