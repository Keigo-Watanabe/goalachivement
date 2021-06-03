<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class CalendarView extends Model
{
    use HasFactory;

    protected $date;

    function __construct($date)
    {
        $this->date = $date;

        // タイムゾーンを日本に設定
        $this->date = $this->date->copy()->timezone('Asia/Tokyo');
    }


    // 今月を取得
    public function getTitle()
    {
        $month = $this->date->copy()->format('Y年n月');

        return $month;
    }


    // カレンダー
    public function calendar()
    {
        /*
        今月の1週間ずつを取得する
        */
        $weeks = [];

        // 週の始まりを日曜に変更
        Carbon::setWeekStartsAt(Carbon::SUNDAY);
        Carbon::setWeekEndsAt(Carbon::SATURDAY);

        // 月の初めの日を取得
        $firstDayOfMonth = $this->date->copy()->startOfMonth();
        // 月の最後の日を取得
        $lastDayOfMonth = $this->date->copy()->endOfMonth();

        // 月の初めの日をコピーして、weeksに格納
        $week = $firstDayOfMonth->copy();
        $weeks[] = $week;

        // 1週目を取得
        $temporaryWeek = $firstDayOfMonth->copy()->addDay(7)->startOfWeek();

        // 1週目から月末まで繰り返し
        while ($temporaryWeek->lte($lastDayOfMonth)) {
          // weekに1週目を代入
          $week = $temporaryWeek->copy();
          // weeksに格納
          $weeks[] = $week;

          // 次の週（+7日）
          $temporaryWeek->addDay(7);
        }

        $html = [];

        // weeksを繰り返し（1週間ごと）
        foreach ($weeks as $week) {
          $html[] = '<tr>';

          /*
          1週間の中で1日ずつ取得する
          */
          $days = [];

          // 週の初めの日を取得
          $firstDay = $week->copy()->startOfWeek();
          // 週の最後の日を取得
          $lastDay = $week->copy()->endOfWeek();

          // 週の初めの日をコピー
          $temporaryDay = $firstDay->copy();

          // 週の初めから週末までを繰り返し（1日ごと）
          while($temporaryDay->lte($lastDay)) {
            // dayに初日を代入
            $day = $temporaryDay->copy();
            // daysに格納
            $days[] = $day;

            // 1日ずつ加算する
            $temporaryDay->addDay(1);
          }

          foreach ($days as $day) {

            // 今日かどうか
            $today = $day->isToday();

            if ($day == $today) {
              $today_class = 'today';
            } else {
              $today_class = null;
            }

            // 日曜の場合
            if ($day->dayOfWeek == 0) {
              $day_class = 'sunday';
            // 土曜の場合
            } else if ($day->dayOfWeek == 6) {
              $day_class = 'saturday';
            // 平日の場合
            } else {
              $day_class = 'weekday';
            }

            // 前後の月の場合
            if ($day->month != $this->date->month) {
              $prev_next_month_class = 'prev-next-month';
              $html[] = '<td class="'.$prev_next_month_class.'">'.$day->format('j').'</td>';
            // 今月の場合
            } else {
              $html[] = '<td class="'.$day_class.' '.$today_class.'">'.$day->format('j').'</td>';
            }
          }


          $html[] = '</tr>';
        }

        return implode("", $html);
    }
}
