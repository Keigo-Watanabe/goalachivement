<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Goal;
use App\Models\TaskCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
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
        $goals = Goal::all();
        $taskCategories = TaskCategory::all();

        return view('task.create', compact('goals', 'taskCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task = new Task();

        $task->content = $request->input('content');
        $task->goal_id = $request->input('goal_id');
        $task->user_id = Auth::id();

        // もしカテゴリーが追加されたら
        if ($request->input('task_category')) {
          // タスクカテゴリーを追加
          $task_category = new TaskCategory();

          $task_category->task_category = $request->input('task_category');
          $task_category->category_color = $request->input('category_color');
          $task_category->save();

          // タスクカテゴリーの最大値のidを取得
          $task_categories = TaskCategory::max('task_category_id');

          // もしタスクカテゴリーが存在したら最大値のidを設定
          if ($task_categories) {
            $task->task_category_id = $task_categories;
          // タスクカテゴリーがなければidを1に設定
          } else {
            $task->task_category_id = 1;
          }

        } else {
          $task->task_category_id = $request->input('task_category_id');
        }

        $task->start_date = $request->input('start_date');
        $task->end_date = $request->input('end_date');
        $task->priority = $request->input('priority');
        $task->severity = $request->input('severity');

        // メモが入力されたら追加
        if ($request->input('memo')) {
          $task->memo = $request->input('memo');
        // メモが入力されなかったらnull
        } else {
          $task->memo = '';
        }

        $task->complete = 0;

        $task->save();

        return redirect()->route('task.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }
}
