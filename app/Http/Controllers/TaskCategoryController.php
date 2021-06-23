<?php

namespace App\Http\Controllers;

use App\Models\taskCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();

        $taskCategories = TaskCategory::where('user_id', $user_id)->get();

        return view('taskcategory.index', compact('taskCategories'));
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
      // カテゴリーのバリデーション
      $request->validate([
        'task_category' => 'required|unique:task_categories,task_category,NULL,user_id,user_id,'.$user_id.',deleted_at,NULL',
        'category_color' => 'required',
      ],
      [
        'task_category.required' => 'カテゴリー名を入力してください',
        'task_category.unique' => '指定のカテゴリー『'.$request->input('task_category').'』はすでに存在しています',
        'category_color.required' => 'カテゴリーの色を選択してください',
      ]);

      $taskCategory = new TaskCategory();

      $taskCategory->user_id = Auth::id();
      $taskCategory->task_category = $request->input('task_category');
      $taskCategory->category_color = $request->input('category_color');
      $taskCategory->save();

      return redirect()->back()->with('message', 'カテゴリーを追加しました。');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TaskCategory  $taskCategory
     * @return \Illuminate\Http\Response
     */
    public function show(TaskCategory $taskCategory)
    {
        // アクセスユーザーidと目標のidが一致しなかった場合は404へ遷移
        if (Auth::id() != $taskCategory->user_id) {
          return abort('404');
        }

        return view('taskcategory.show', compact('taskCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TaskCategory  $taskCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TaskCategory $taskCategory)
    {
        $user_id = Auth::id();
        // カテゴリーのバリデーション
        $request->validate([
          'task_category' => 'required',
        ],
        [
          'task_category.required' => 'カテゴリー名を入力してください',
        ]);

        if ($request->input('task_category') == $taskCategory->task_category) {
          // カテゴリー名に変更がなければそのままデータを更新
          $taskCategory->task_category = $request->input('task_category');
        } else {
          // カテゴリー名を変更する場合は重複チェックを行う
          $request->validate([
            'task_category' => 'unique:task_categories,task_category,NULL,user_id,user_id,'.$user_id.',deleted_at,NULL',
          ],
          [
            'task_category.unique' => '指定のカテゴリー『'.$request->input('task_category').'』はすでに存在しています',
          ]);

          $taskCategory->task_category = $request->input('task_category');
        }

        $taskCategory->category_color = $request->input('category_color');
        $taskCategory->save();

        return redirect()->to('/task_category')->with('message', 'カテゴリーを変更しました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TaskCategory  $taskCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaskCategory $taskCategory)
    {
        $taskCategory->delete();

        return redirect()->to('/task_category')->with('message', 'カテゴリーを削除しました');
    }
}
