<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\GoalView;
use App\Models\CalendarView;
use App\Models\Schedule;
use App\Models\CommonSchedule;
use App\Models\Task;
use App\Models\taskCategory;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $goals = new GoalView();

      $getGoal = $goals->getGoal();

      // dateパラメータを取得
      $date = $request->input('date');

      // dateパラメータが存在したら
      if ($date) {
        // パラメータの日付をCarbonに指定
        $date = new Carbon($date.'-01');
      } else {
        // 存在しない場合は現在の日付
        $date = new Carbon();
      }

      $calendar = new CalendarView($date);

      $getTitle = $calendar->getTitle();
      $getCalendar = $calendar->calendar();
      $prevMonth = $calendar->prevMonth();
      $nextMonth = $calendar->nextMonth();

      $user_id = Auth::id();
      $schedules = Schedule::where('user_id', $user_id)->where('start_time', 'like', date('Y-m-d', strtotime($date)).'%')->orderBy('start_time', 'asc')->get();
      $commonSchedules = CommonSchedule::where('user_id', $user_id)->get();

      $day = date('Y-m-d', strtotime($date));

      $tasks = Task::where('user_id', $user_id)->get();
      $task_categories = TaskCategory::where('user_id', $user_id)->get();

      return view('dashboard', compact('getGoal', 'date', 'getTitle', 'getCalendar', 'prevMonth', 'nextMonth', 'schedules', 'commonSchedules', 'day', 'tasks', 'task_categories'));
    }
}
