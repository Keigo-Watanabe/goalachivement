<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Goal;
use Carbon\Carbon;

class GoalView
{
  public function getGoal()
  {
      $html = [];

      $date = new Carbon();
      $goals = Goal::orderBy('created_at', 'desc')->get();

      // 目標一覧取得
      foreach ($goals as $goal) {
        $html[] = '<li>';
        $html[] = '<div class="goal-name">'.$goal->title.'</div>';
        $html[] = '<div class="goal-graph-content">';
        $html[] = '<div class="goal-start">';
        $html[] = '<span class="goal-start-date">'.date('n/j', strtotime($goal->created_at)).'</span>';
        $html[] = '<i class="fas fa-campground"></i>';
        $html[] = '</div>';
        $html[] = '<div class="goal-graph">';
        $html[] = '<div class="goal-bar">';

        // 目標開始日〜終了日
        $goal_term = $goal->created_at->diffInDays($goal->date);
        // 目標開始日〜現在
        $goal_now = $goal->created_at->diffInDays($date);

        if ($goal_term == 0) {
          $goal_term = 1;
        } else if ($goal_now == 0) {
          $goal_now = 1;
        }

        $goal_percent = $goal_now / $goal_term;
        $goal_percent = round($goal_percent, 2) * 100;

        if ($date > $goal->date) {
          $html[] = '<span class="goal-bar-inner" style="width: 100%;">';
        } else {
          $html[] = '<span class="goal-bar-inner" style="width: '.$goal_percent.'%;">';
        }

        $html[] = '<span class="goal-icon"><i class="fas fa-hiking"></i></span>';
        $html[] = '<span class="goal-persent-triangle"></span>';

        if ($date > $goal->date) {
          $html[] = '<span class="goal-persent">100%</span>';
        } else {
          $html[] = '<span class="goal-persent">'.$goal_percent.'%</span>';
        }

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

      return implode("", $html);
  }
}
