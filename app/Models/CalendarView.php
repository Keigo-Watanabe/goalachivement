<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Yasumi\Yasumi;
use Yasumi\Holiday;
use Carbon\Carbon;
use App\Models\Schedule;
use App\Models\CommonSchedule;
use Illuminate\Support\Facades\Auth;

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


    // 前月
    public function prevMonth()
    {
        return $this->date->copy()->subMonth()->format('Y-m');
    }


    // 来月
    public function nextMonth()
    {
        return $this->date->copy()->addMonth()->format('Y-m');
    }


    // カレンダー
    public function calendar()
    {
        /*
        祝日を取得
        */
        $year = $this->date->format('Y');

        $holidays = Yasumi::create('Japan', $year, 'ja_JP');

        // 2021年に変更になった祝日
        $marineDay = new \Yasumi\Holiday('Marine Day', ['ja_JP' => '海の日'], new Carbon('2021-07-22'), 'ja_JP');
        $sportsDay = new \Yasumi\Holiday('Sports Day', ['ja_JP' => 'スポーツの日'], new Carbon('2021-07-23'), 'ja_JP');
        $mountainDay = new \Yasumi\Holiday('Mountain Day', ['ja_JP' => '振替休日'], new Carbon('2021-08-09'), 'ja_JP');

        $holidays->addHoliday($marineDay);
        $holidays->addHoliday($sportsDay);
        $holidays->addHoliday($mountainDay);
        // 2021年が終わったら削除 ↑


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

            // 祝日かどうか
            $holiday = $holidays->isHoliday($day);

            // 今日かどうか
            $today = $day->isToday();

            if ($day == $today) {
              $today_class = 'today';
            } else {
              $today_class = null;
            }

            // 2021年に移動した祝日の場合
            if ($day->format('Y-m-d') == '2021-07-19' || $day->format('Y-m-d') == '2021-08-11' || $day->format('Y-m-d') == '2021-10-11') {
              $day_class = 'weekday';
            // 祝日の場合
            } else if ($holiday) {
              $day_class = 'holiday';
            // 日曜の場合
            } else if ($day->dayOfWeek == 0) {
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
              $html[] = '<td class="'.$day_class.' '.$today_class.'">';
              $html[] = '<a href="/dashboard/?date='.$day->format('Y-m-d\TH:i').'">'.$day->format('j');

              // 予定があるかどうか
              $user_id = Auth::id();
              $schedules = Schedule::where('user_id', $user_id)->where('start_time', 'like', $day->format('Y-m-d').'%')->orderBy('start_time', 'asc')->get();

              // 予定の数をカウント
              $counter = 0;

              foreach ($schedules as $schedule) {
                // 予定のグループを取得
                $commonSchedules = CommonSchedule::where('user_id', $user_id)->get();

                if ($schedule->common_schedule_id == 0) {
                  // 予定のグループがない場合
                  $html[] = '<span class="schedule-icon" style="background: #cecece;">'.$schedule->content.'</span>';
                } else {
                  // 予定のグループがある場合
                  foreach ($commonSchedules as $commonSchedule) {
                    if ($schedule->common_schedule_id == $commonSchedule->common_schedule_id) {
                      $html[] = '<span class="schedule-icon" style="background: '.$commonSchedule->common_color.';">'.$schedule->content.'</span>';
                    }
                  }
                }

                $counter++;

                if ($counter >= 2) {
                  $html[] = '<span class="schedule-dot">･･･</span>';
                  break;
                }
              }

              $html[] = '</a>';
              $html[] = '</td>';
            }
          }


          $html[] = '</tr>';
        }

        return implode("", $html);
    }
}
