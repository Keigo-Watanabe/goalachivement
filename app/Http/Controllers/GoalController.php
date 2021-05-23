<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use App\Models\GoalChart;
use App\Models\Task;
use Illuminate\Http\Request;
use Carbon\Carbon;

class GoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

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
        // 目標のバリデーション
        $request->validate([
          'title' => 'required',
          'date' => 'required',
        ],
        [
          'title.required' => '目標を設定してください',
          'date.required' => '達成日を設定してください',
        ]);

        $goal = new Goal();

        $goal->title = $request->input('title');
        $goal->date = $request->input('date');

        $goal->save();

        return redirect()->route('goal.create');
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

        if ($goal_term == 0) {
          $goal_term = 1;
        } else if ($goal_now == 0) {
          $goal_now = 1;
        }

        $goal_percent = $goal_now / $goal_term;

        // 円グラフの角度
        if ($goal_percent == 1) {
          $goal_circle_percent = 360;
        } else {
          $goal_circle_percent = 360 * round($goal_percent, 2);
        }
        $goal_circle_percent = round($goal_circle_percent, 0);

        // 目標の進行率
        $goal_percent = round($goal_percent, 2) * 100;

        // 残りの日数
        $goal_remaining_days = $goal_term - $goal_now;


        // タスクを取得
        $tasks = Task::where('goal_id', $goal->goal_id)->get();

        $goal_view = new GoalChart($goal);
        $goal_chart = $goal_view->goalChart();

        return view('goal.show', compact('goal', 'date', 'goal_circle_percent', 'goal_percent', 'goal_remaining_days', 'tasks', 'goal_chart'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function edit(Goal $goal)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Goal $goal)
    {
        //
    }
}
