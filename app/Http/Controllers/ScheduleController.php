<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\CommonSchedule;
use App\Models\Task;
use App\Models\taskCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->input('date')) {
          $date = $request->input('date');
        } else {
          $date = null;
        }

        $day = date('Y-m-d', strtotime($date));

        $user_id = Auth::id();

        $schedules = Schedule::where('user_id', $user_id)->where('start_time', 'like', $day.'%')->orderBy('start_time', 'asc')->get();
        $commonSchedules = CommonSchedule::where('user_id', $user_id)->get();

        $tasks = Task::where('user_id', $user_id)->get();
        $task_categories = TaskCategory::where('user_id', $user_id)->get();

        return view('schedule.index', compact('date', 'schedules', 'commonSchedules', 'tasks', 'task_categories', 'day'));
    }


    /*
    予定一覧
    */
    public function sammary()
    {
        $user_id = Auth::id();
        $schedules = Schedule::where('user_id', $user_id)->orderBy('start_time', 'asc')->get();
        $commonSchedules = CommonSchedule::where('user_id', $user_id)->get();

        $schedules_date = Schedule::where('user_id', $user_id)->orderBy('start_time', 'asc')->get(['start_time']);

        $schedule_date = [];

        foreach ($schedules_date as $schedule) {
          // 配列に格納
          $schedule_date[] = date('Y-m-d', strtotime($schedule->start_time));
        }

        // 同じ日にちは1つにまとめる
        $schedule_date = array_unique($schedule_date);

        $day = new Carbon();
        $day = $day->copy()->timezone('Asia/Tokyo')->format('Y-m-d');

        return view('schedule.sammary', compact('schedules', 'commonSchedules', 'schedule_date', 'day'));
    }


    /*
    予定一覧（グループ別）
    */
    public function common()
    {
        $user_id = Auth::id();
        $schedules = Schedule::where('user_id', $user_id)->orderBy('start_time', 'asc')->get();
        $commonSchedules = CommonSchedule::where('user_id', $user_id)->get();

        $day = new Carbon();
        $day = $day->copy()->timezone('Asia/Tokyo')->format('Y-m-d');

        return view('schedule.common', compact('schedules', 'commonSchedules', 'day'));
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
        'content' => 'required|max:100',
        'title' => 'unique:common_schedules,title,NULL,user_id,user_id,'.$user_id.',deleted_at,NULL',
      ],
      [
        'content.required' => '予定を記入してください',
        'content.max' => '予定は100文字以内で入力してください',
        'title.unique' => '指定のグループ『'.$request->input('title').'』はすでに存在しています',
      ]);

      $schedule = new Schedule();

      $schedule->content = $request->input('content');
      $schedule->user_id = Auth::id();

      // もしグループが追加されたら
      if ($request->input('title')) {
        $request->validate([
          'common_color' => 'required',
        ],
        [
          'common_color.required' => 'グループの色を選択してください',
        ]);

        // 予定グループを追加
        $common_schedule = new CommonSchedule();

        $common_schedule->user_id = Auth::id();
        $common_schedule->title = $request->input('title');
        $common_schedule->common_color = $request->input('common_color');
        $common_schedule->save();

        // 予定グループの最大値のidを取得
        $common_schedules = CommonSchedule::where('user_id', $user_id)->max('common_schedule_id');

        // もし予定グループが存在したら最大値のidを設定
        if ($common_schedules) {
          $schedule->common_schedule_id = $common_schedules;
        }

      } else {
        $schedule->common_schedule_id = $request->input('common_schedule_id');
      }

      $schedule->start_time = $request->input('start_time');
      $schedule->end_time = $request->input('end_time');

      // 予定終了時間が入力されなかったら
      if ($request->input('end_time') == null) {
        $schedule->end_time = $request->input('start_time');
      } else {
        $schedule->end_time = $request->input('end_time');
      }

      // メモが入力されたら
      if ($request->input('memo')) {
        $schedule->memo = $request->input('memo');
      // 入力されなかったら空
      } else {
        $schedule->memo = '';
      }

      $schedule->save();

      return redirect()->back()->with('message', '予定を追加しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {
        // アクセスユーザーidと目標のidが一致しなかった場合は404へ遷移
        if (Auth::id() != $schedule->user_id) {
          return abort('404');
        }

        $user_id = Auth::id();
        $commonSchedules = CommonSchedule::where('user_id', $user_id)->get();

        return view('schedule.show', compact('schedule', 'commonSchedules'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
      $user_id = Auth::id();

      // 予定のバリデーション
      $request->validate([
        'content' => 'required|max:100',
        'title' => 'unique:common_schedules,title,NULL,user_id,user_id,'.$user_id.',deleted_at,NULL',
      ],
      [
        'content.required' => '予定を記入してください',
        'content.max' => '予定は100文字以内で入力してください',
        'title.unique' => '指定のグループ『'.$request->input('title').'』はすでに存在しています',
      ]);

      $schedule->content = $request->input('content');
      $schedule->user_id = Auth::id();

      // もしグループが追加されたら
      if ($request->input('title')) {
        $request->validate([
          'common_color' => 'required',
        ],
        [
          'common_color.required' => 'グループの色を選択してください',
        ]);

        // 予定グループを追加
        $common_schedule = new CommonSchedule();

        $common_schedule->user_id = Auth::id();
        $common_schedule->title = $request->input('title');
        $common_schedule->common_color = $request->input('common_color');
        $common_schedule->save();

        // 予定グループの最大値のidを取得
        $common_schedules = CommonSchedule::where('user_id', $user_id)->max('common_schedule_id');

        // もし予定グループが存在したら最大値のidを設定
        if ($common_schedules) {
          $schedule->common_schedule_id = $common_schedules;
        }

      } else {
        $schedule->common_schedule_id = $request->input('common_schedule_id');
      }

      $schedule->start_time = $request->input('start_time');
      $schedule->end_time = $request->input('end_time');

      // 予定終了時間が入力されなかったら
      if ($request->input('end_time') == null) {
        $schedule->end_time = $request->input('start_time');
      } else {
        $schedule->end_time = $request->input('end_time');
      }

      // メモが入力されたら
      if ($request->input('memo')) {
        $schedule->memo = $request->input('memo');
      // 入力されなかったら空
      } else {
        $schedule->memo = '';
      }

      $schedule->save();

      return redirect()->back()->with('message', '予定を変更しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Schedule $schedule)
    {
        $schedule->content = $request->input('content');
        $schedule->delete();

        return redirect()->to('/schedulesammary')->with([
          'schedule_content' => $schedule->content,
          'message' => 'を削除しました',
        ]);
    }
}
