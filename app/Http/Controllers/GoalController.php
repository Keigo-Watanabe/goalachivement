<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use App\Models\GoalChart;
use App\Models\Task;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class GoalController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('goal.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = Auth::id();
        // 目標のバリデーション
        $request->validate([
          'title' => ['required', 'max:100', 'unique:goals,title,NULL,user_id,user_id,'.$user_id.',deleted_at,NULL'],
          'date' => 'required',
        ],
        [
          'title.required' => '目標を設定してください',
          'title.max' => '目標は100文字までで設定してください',
          'title.unique' => '指定の目標はすでに登録されています',
          'date.required' => '達成日を設定してください',
        ]);

        $goal = new Goal();

        $goal->user_id = Auth::id();
        $goal->title = $request->input('title');
        $goal->date = $request->input('date');

        $goal->save();

        return redirect()->route('task.create')->with('message', '目標が設定されました。次はタスクを追加しましょう。');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function show(Goal $goal)
    {
        $date = new Carbon();
        $date = $date->copy()->timezone('Asia/Tokyo');

        // 目標開始日〜終了日
        $goal_term = $goal->created_at->diffInDays($goal->date);
        // 目標開始日〜現在
        $goal_now = $goal->created_at->diffInDays($date);

        // 残りの日数
        $goal_remaining_days = $goal_term - $goal_now;

        // タスクを取得
        $user_id = Auth::id();
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

        if ($sum == 0) {
          $goal_circle_percent = 1 / 100;
        } else {
          $goal_circle_percent = $sum / 100;
        }
        $goal_circle_percent = 360 * $goal_circle_percent;

        // 円グラフが180度以上の場合
        $mul = 360 - $goal_circle_percent;


        $goal_view = new GoalChart($goal);
        $goal_chart = $goal_view->goalChart();
        $task_chart = $goal_view->taskChart();

        return view('goal.show', compact('goal', 'date', 'sum', 'goal_circle_percent', 'mul', 'goal_remaining_days', 'tasks', 'goal_chart', 'task_chart'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Goal $goal)
    {
      // 目標のバリデーション
      $request->validate([
        'date' => 'required',
      ],
      [
        'date.required' => '達成日を設定してください',
      ]);

      $goal->date = $request->input('date');
      $goal->save();

      return redirect()->back()->with('message', '達成日を変更しました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Goal $goal)
    {
        $goal->title = $request->input('title');

        $user_id = Auth::id();
        $tasks = Task::where('user_id', $user_id)->get();

        foreach ($tasks as $task) {
          // 目標に含まれるタスクも削除
          if ($task->goal_id == $goal->goal_id) {
            $task->delete();
          }
        }

        $goal->delete();

        return redirect()->to('/dashboard')->with([
          'goal_title' => $goal->title,
          'message' => 'を削除しました。',
        ]);
    }
}
