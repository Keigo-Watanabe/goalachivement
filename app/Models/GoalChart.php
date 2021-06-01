<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Goal;
use App\Models\Task;
use Carbon\Carbon;

class GoalChart
{
    protected $goal;

    function __construct($goal)
    {
        $this->goal = $goal;
    }

    // 目標のタスク（ガントチャートの日にち）
    public function goalChart()
    {
        $html = [];

        // 目標開始日
        $start_date = $this->goal->created_at;
        $start_date = new Carbon($start_date);

        // 目標達成日
        $end_date = date('Y-m-d H:i:s', strtotime($this->goal->date));
        $end_date = new Carbon($end_date);
        $end_date = $end_date->addDay(1);

        // 開始日から達成日までの日にちを繰り返し処理
        $days = [];

        while($start_date->lte($end_date)) {
          // 開始日をコピー
          $day = $start_date->copy();

          // コピーした開始日を$daysに格納
          $days[] = $day;

          // 開始日に1日追加
          $start_date->addDay(1);
        }

        foreach ($days as $day) {
          $today = new Carbon();
          $today = $today->copy()->timezone('Asia/Tokyo');

          if (date('Y-m-d', strtotime($day)) == date('Y-m-d', strtotime($today))) {
            $html[] = '<div id="th-today" class="th th-today">'.date('n/j', strtotime($day)).'</div>';
          } else {
            $html[] = '<div class="th">'.date('n/j', strtotime($day)).'</div>';
          }
        }

        return implode("", $html);
    }

    // 目標のタスクのグラフ（ガントチャート）
    public function taskChart()
    {
        $html = [];

        // 目標開始日
        $start_date = $this->goal->created_at;
        $start_date = new Carbon($start_date);

        // 目標達成日
        $end_date = date('Y-m-d H:i:s', strtotime($this->goal->date));
        $end_date = new Carbon($end_date);
        $end_date = $end_date->addDay(1);

        // 開始日から達成日までの日にちを繰り返し処理
        $days = [];

        while($start_date->lte($end_date)) {
          // 開始日をコピー
          $day = $start_date->copy();

          // コピーした開始日を$daysに格納
          $days[] = $day;

          // 開始日に1日追加
          $start_date->addDay(1);
        }


        $tasks = Task::where('goal_id', $this->goal->goal_id)->get();

        foreach ($tasks as $task) {
          $html[] = '<div class="table-row">';

          $task->end_date = new Carbon($task->end_date);
          $task->end_date = $task->end_date->addDay(1);

          foreach ($days as $day) {
            if ($task->start_date < $day && $day <= $task->end_date) {
              $html[] = '<div class="td"><span class="task-chart-bar"></span></div>';
            } else {
              $html[] = '<div class="td"></div>';
            }
          }

          $html[] = '</div>';
        }

        return implode("", $html);
    }
}
