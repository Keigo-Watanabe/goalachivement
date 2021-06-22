<?php

namespace App\Http\Controllers;

use App\Models\CommonSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommonScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();

        $commonSchedules = CommonSchedule::where('user_id', $user_id)->get();

        return view('commonschedule.index', compact('commonSchedules'));
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
        // 予定のバリデーション
        $request->validate([
          'title' => 'required|unique:common_schedules,title,NULL,user_id,user_id,'.$user_id.',deleted_at,NULL',
          'common_color' => 'required',
        ],
        [
          'title.required' => 'グループ名を入力してください',
          'title.unique' => '指定のグループ『'.$request->input('title').'』はすでに存在しています',
          'common_color.required' => 'グループの色を選択してください',
        ]);

        $commonSchedule = new CommonSchedule();

        $commonSchedule->user_id = Auth::id();
        $commonSchedule->title = $request->input('title');
        $commonSchedule->common_color = $request->input('common_color');
        $commonSchedule->save();

        return redirect()->back()->with('message', 'グループを追加しました。');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CommonSchedule  $commonSchedule
     * @return \Illuminate\Http\Response
     */
    public function show(CommonSchedule $commonSchedule)
    {
        return view('commonschedule.show', compact('commonSchedule'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CommonSchedule  $commonSchedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CommonSchedule $commonSchedule)
    {
        $user_id = Auth::id();
        // グループのバリデーション
        $request->validate([
          'title' => 'required',
          'common_color' => 'required',
        ],
        [
          'title.required' => 'グループ名を入力してください',
          'common_color.required' => 'グループの色を選択してください',
        ]);

        if ($request->input('title') == $commonSchedule->title) {
          // グループ名に変更がなければそのまま更新
          $commonSchedule->title = $request->input('title');
        } else {
          // グループ名を変更する場合は重複チェックを行う
          $request->validate([
            'title' => 'unique:common_schedules,title,NULL,user_id,user_id,'.$user_id.',deleted_at,NULL',
          ],
          [
            'title.unique' => '指定のグループ『'.$request->input('title').'』はすでに存在しています',
          ]);

          $commonSchedule->title = $request->input('title');
        }

        $commonSchedule->common_color = $request->input('common_color');
        $commonSchedule->save();

        return redirect()->to('/common_schedule')->with('message', 'グループを変更しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CommonSchedule  $commonSchedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(CommonSchedule $commonSchedule)
    {
        $commonSchedule->delete();

        return redirect()->to('/common_schedule')->with('message', 'グループを削除しました');
    }
}
