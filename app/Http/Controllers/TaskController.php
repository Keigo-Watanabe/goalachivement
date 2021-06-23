<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Goal;
use App\Models\taskCategory;
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
        $user_id = Auth::id();
        $tasks = Task::where('user_id', $user_id)->orderBy('start_date', 'asc')->get();
        $task_categories = TaskCategory::where('user_id', $user_id)->get();

        return view('task.index', compact('tasks', 'task_categories'));
    }

    public function category()
    {
        $user_id = Auth::id();
        $tasks = Task::where('user_id', $user_id)->orderBy('start_date', 'asc')->get();
        $task_categories = TaskCategory::where('user_id', $user_id)->get();

        return view('task.category', compact('tasks', 'task_categories'));
    }

    public function priority()
    {
        $user_id = Auth::id();
        // カラム「priority」のデータのみ取得
        $tasks_priority_array = Task::where('user_id', $user_id)->orderBy('priority', 'desc')->orderBy('start_date', 'asc')->get(['priority']);
        $task_priority = [];

        foreach ($tasks_priority_array as $task) {
          // データを配列に格納
          $task_priority[] = $task->priority;
        }

        // 配列の重複チェック（同じ数字は1つにまとめる）
        $task_priority = array_unique($task_priority);

        $tasks = Task::where('user_id', $user_id)->orderBy('start_date', 'asc')->get();

        $task_categories = TaskCategory::where('user_id', $user_id)->get();

        return view('task.priority', compact('tasks', 'task_priority', 'task_categories'));
    }

    public function severity()
    {
        $user_id = Auth::id();
        // カラム「severity」のデータのみ取得
        $tasks_severity_array = Task::where('user_id', $user_id)->orderBy('severity', 'desc')->orderBy('start_date', 'asc')->get(['severity']);
        $task_severity = [];

        foreach ($tasks_severity_array as $task) {
          // データを配列に格納
          $task_severity[] = $task->severity;
        }

        // 配列の重複チェック（同じ数字は1つにまとめる）
        $task_severity = array_unique($task_severity);

        $tasks = Task::where('user_id', $user_id)->orderBy('start_date', 'asc')->get();

        $task_categories = TaskCategory::where('user_id', $user_id)->get();

        return view('task.severity', compact('tasks', 'task_severity', 'task_categories'));
    }

    public function totallpriority()
    {
        $user_id = Auth::id();
        $tasks = Task::where('user_id', $user_id)->orderBy('severity', 'desc')->orderBy('priority', 'desc')->where('complete', 0)->get();
        $task_categories = TaskCategory::where('user_id', $user_id)->get();

        // 重要・緊急
        $matrix_a = [];
        $matrix_b = [];
        $matrix_c = [];
        $matrix_d = [];

        foreach ($tasks as $task) {
          if ($task->priority >= 3 && $task->severity >= 3) {
            $matrix_a[] = $task->task_id;
          } else if ($task->priority >= 3 && $task->severity < 3) {
            $matrix_b[] = $task->task_id;
          } else if ($task->priority < 3 && $task->severity >= 3) {
            $matrix_c[] = $task->task_id;
          } else if ($task->priority < 3 && $task->severity < 3) {
            $matrix_d[] = $task->task_id;
          }
        }

        $matrix_a_count = count($matrix_a);
        $matrix_b_count = count($matrix_b);
        $matrix_c_count = count($matrix_c);
        $matrix_d_count = count($matrix_d);

        return view('task.totallpriority', compact('tasks', 'task_categories', 'matrix_a_count', 'matrix_b_count', 'matrix_c_count', 'matrix_d_count'));
    }

    public function complete()
    {
        $user_id = Auth::id();
        $tasks = Task::where('user_id', $user_id)->orderBy('start_date', 'asc')->where('complete', 1)->get();
        $task_categories = TaskCategory::where('user_id', $user_id)->get();

        return view('task.complete', compact('tasks', 'task_categories'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_id = Auth::id();
        $goals = Goal::where('user_id', $user_id)->get();
        $goals_latest = Goal::where('user_id', $user_id)->max('goal_id');
        $taskCategories = TaskCategory::where('user_id', $user_id)->get();

        return view('task.create', compact('goals', 'goals_latest', 'taskCategories'));
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
        // タスクカテゴリーのバリデーション
        $request->validate([
          'content' => 'required|max:100',
          'task_category' => 'unique:task_categories,task_category,NULL,user_id,user_id,'.$user_id.',deleted_at,NULL',
          'start_date' => 'required',
          'end_date' => 'required',
          'priority' => 'required',
          'severity' => 'required',
          'memo' => 'max:100',
        ],
        [
          'content.required' => 'タスクを記入してください',
          'content.max' => 'タスクは100文字以内で入力してください',
          'task_category.unique' => '指定のカテゴリー『'.$request->input('task_category').'』はすでに存在しています',
          'start_date.required' => '開始日を設定してください',
          'end_date.required' => '完了日を設定してください',
          'priority.required' => 'タスクの重要度を設定してください',
          'severity.required' => 'タスクの緊急度を設定してください',
          'memo.max' => 'メモは100文字以内で入力してください',
        ]);


        $task = new Task();

        $task->content = $request->input('content');
        $task->goal_id = $request->input('goal_id');
        $task->user_id = Auth::id();

        // もしカテゴリーが追加されたら
        if ($request->input('task_category')) {
          $request->validate([
            'category_color' => 'required',
          ],
          [
            'category_color.required' => 'カテゴリーの色を選択してください',
          ]);

          // タスクカテゴリーを追加
          $task_category = new TaskCategory();

          $task_category->user_id = Auth::id();
          $task_category->task_category = $request->input('task_category');
          $task_category->category_color = $request->input('category_color');
          $task_category->save();

          // タスクカテゴリーの最大値のidを取得
          $task_categories = TaskCategory::where('user_id', $user_id)->max('task_category_id');

          // もしタスクカテゴリーが存在したら最大値のidを設定
          if ($task_categories) {
            $task->task_category_id = $task_categories;
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

        return redirect()->route('task.create')->with('message', 'タスクを追加しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        // アクセスユーザーidと目標のidが一致しなかった場合は404へ遷移
        if (Auth::id() != $task->user_id) {
          return abort('404');
        }

        $user_id = Auth::id();
        $goals = Goal::where('user_id', $user_id)->get();
        $taskCategories = TaskCategory::where('user_id', $user_id)->get();

        return view('task.show', compact('task', 'goals', 'taskCategories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $user_id = Auth::id();
        $goals = Goal::where('user_id', $user_id)->get();
        $taskCategories = TaskCategory::where('user_id', $user_id)->get();

        return view('task.edit', compact('task', 'goals', 'taskCategories'));
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
        if ($request->input('complete')) {
          $task->content = $request->input('content');
          $task->complete = 1;
          $task->save();

          return redirect()->back()->with([
            'task_content' => $task->content,
            'message' => 'が完了しました',
          ]);
        }

        if ($request->input('uncomplete')) {
          $task->content = $request->input('content');
          $task->complete = 0;
          $task->save();

          return redirect()->back()->with([
            'task_content' => $task->content,
            'message' => 'の完了を取り消しました',
          ]);
        }

        $user_id = Auth::id();

        // タスクカテゴリーのバリデーション
        $request->validate([
          'content' => 'required|max:100',
          'task_category' => 'unique:task_categories,task_category,NULL,user_id,user_id,'.$user_id.',deleted_at,NULL',
          'start_date' => 'required',
          'end_date' => 'required',
          'priority' => 'required',
          'severity' => 'required',
          'memo' => 'max:100',
        ],
        [
          'content.required' => 'タスクを記入してください',
          'content.max' => 'タスクは100文字以内で入力してください',
          'task_category.unique' => '指定のカテゴリー『'.$request->input('task_category').'』はすでに存在しています',
          'start_date.required' => '開始日を設定してください',
          'end_date.required' => '完了日を設定してください',
          'priority.required' => 'タスクの重要度を設定してください',
          'severity.required' => 'タスクの緊急度を設定してください',
          'memo.max' => 'メモは100文字以内で入力してください',
        ]);

        $task->content = $request->input('content');
        $task->goal_id = $request->input('goal_id');
        $task->user_id = Auth::id();

        // もしカテゴリーが追加されたら
        if ($request->input('task_category')) {
          $request->validate([
            'category_color' => 'required',
          ],
          [
            'category_color.required' => 'カテゴリーの色を選択してください',
          ]);

          // タスクカテゴリーを追加
          $task_category = new TaskCategory();

          $task_category->user_id = Auth::id();
          $task_category->task_category = $request->input('task_category');
          $task_category->category_color = $request->input('category_color');
          $task_category->save();

          // タスクカテゴリーの最大値のidを取得
          $task_categories = TaskCategory::where('user_id', $user_id)->max('task_category_id');

          // もしタスクカテゴリーが存在したら最大値のidを設定
          if ($task_categories) {
            $task->task_category_id = $task_categories;
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

        $task->save();

        return redirect()->back()->with([
          'task_content' => $task->content,
          'message' => 'の編集が完了しました',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Task $task)
    {
        $task->content = $request->input('content');
        $task->delete();

        return redirect()->route('task.index')->with([
          'task_content' => $task->content,
          'message' => 'を削除しました',
        ]);
    }
}
