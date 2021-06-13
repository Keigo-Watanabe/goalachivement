<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Goal;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class GoalView
{
  // 目標一覧
  public function getGoal()
  {
      $html = [];

      $date = new Carbon();
      $date = $date->copy()->timezone('Asia/Tokyo');
      $user_id = Auth::id();
      $goals = Goal::where('user_id', $user_id)->orderBy('created_at', 'desc')->get();

      if ($goals->count() == 0) {
        $html[] = '<div class="no-goal">目標がありません</div>';
      } else {
        // 目標一覧取得
        foreach ($goals as $goal) {
          $html[] = '<li>';
          $html[] = '<div class="goal-name"><a href="/goal/'.$goal->goal_id.'">'.$goal->title.'</a></div>';
          $html[] = '<div class="goal-graph-content">';
          $html[] = '<div class="goal-start">';
          $html[] = '<span class="goal-start-date">'.date('n/j', strtotime($goal->created_at)).'</span>';
          $html[] = '<i class="fas fa-campground"></i>';
          $html[] = '</div>';
          $html[] = '<div class="goal-graph">';
          $html[] = '<div class="goal-bar">';

          $tasks = Task::where('user_id', $user_id)->where('goal_id', $goal->goal_id)->get();

          // タスクの数を計算
          $tasks_number = count($tasks);

          // タスクの数が0の場合は1にする（0のままだと計算できないため）
          if ($tasks_number == 0) {
            $tasks_number = 1;
          }
          // タスク1つの完了率を計算
          $goal_percent = 100 / $tasks_number;

          $task_complete = [];

          foreach ($tasks as $task) {
            // タスクが完了すれば、完了率を配列に格納
            if ($task->complete == 1) {
              $task_complete[] = $goal_percent;
            }
          }

          // 配列に格納された完了率の合計を計算
          $sum = array_sum($task_complete);
          $sum = floor($sum);

          $html[] = '<span class="goal-bar-inner" style="width: '.$sum.'%;">';

          $html[] = '<span class="goal-icon"><i class="fas fa-hiking"></i></span>';
          $html[] = '<span class="goal-persent-triangle"></span>';
          $html[] = '<span class="goal-persent">'.$sum.'%</span>';

          $html[] = '</span>';
          $html[] = '</div>';
          $html[] = '</div>';
          $html[] = '<div class="goal-finish">';
          $html[] = '<span class="goal-end-date">'.date('n/j', strtotime($goal->date)).'</span>';
          $html[] = '<i class="fas fa-mountain"></i>';
          $html[] = '</div>';
          $html[] = '</div>';
          $html[] = '</li>';
        }
      }

      return implode("", $html);
  }
}
