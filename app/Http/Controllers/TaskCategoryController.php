<?php

namespace App\Http\Controllers;

use App\Models\TaskCategory;
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TaskCategory  $taskCategory
     * @return \Illuminate\Http\Response
     */
    public function show(TaskCategory $taskCategory)
    {
        return view('taskcategory.show', compact('taskCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TaskCategory  $taskCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(TaskCategory $taskCategory)
    {
        //
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
          'task_category' => 'required|unique:task_categories,task_category,NULL,user_id,user_id,'.$user_id.',deleted_at,NULL',
        ],
        [
          'task_category.required' => 'カテゴリーを入力してください',
          'task_category.unique' => '指定のカテゴリー『'.$request->input('task_category').'』はすでに存在しています',
        ]);

        $taskCategory->task_category = $request->input('task_category');
        $taskCategory->category_color = $request->input('category_color');
        $taskCategory->save();

        return redirect()->back()->with('message', 'カテゴリーを変更しました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TaskCategory  $taskCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaskCategory $taskCategory)
    {
        //
    }
}
