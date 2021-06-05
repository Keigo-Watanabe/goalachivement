<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\CommonSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $schedules = Schedule::where('start_time', 'like', $day.'%')->get();
        $commonSchedules = CommonSchedule::all();

        return view('schedule.index', compact('date', 'schedules', 'commonSchedules'));
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
      // 予定のバリデーション
      $request->validate([
        'content' => 'required',
        'title' => 'unique:common_schedules',
        'start_time' => 'required',
      ],
      [
        'content.required' => '予定を記入してください',
        'title.unique' => '指定のグループ『'.$request->input('title').'』はすでに存在しています',
        'start_time.required' => '予定開始時間を設定してください',
      ]);

      $schedule = new Schedule();

      $schedule->content = $request->input('content');
      $schedule->user_id = Auth::id();

      // もしグループが追加されたら
      if ($request->input('title')) {
        // 予定グループを追加
        $common_schedule = new CommonSchedule();

        $common_schedule->title = $request->input('title');
        $common_schedule->common_color = $request->input('common_color');
        $common_schedule->save();

        // 予定グループの最大値のidを取得
        $common_schedules = CommonSchedule::max('common_schedule_id');

        // もし予定グループが存在したら最大値のidを設定
        if ($common_schedules) {
          $schedule->common_schedule_id = $common_schedules;
        // 予定グループがなければidを1に設定
        } else {
          $schedule->common_schedule_id = 1;
        }

      } else {
        $schedule->common_schedule_id = $request->input('common_schedule_id');
      }

      $schedule->start_time = $request->input('start_time');

      // 予定終了時間が入力されたら
      if ($request->input('end_time')) {
        $schedule->end_time = $request->input('end_time');
      // 入力されなかったら空
      } else {
        $schedule->end_time = $request->input('start_time');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        //
    }
}