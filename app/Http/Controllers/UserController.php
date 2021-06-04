<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\GoalView;
use App\Models\CalendarView;
use Illuminate\Http\Request;
use Carbon\Carbon;

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

      return view('dashboard', compact('getGoal', 'getTitle', 'getCalendar', 'prevMonth', 'nextMonth'));
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
