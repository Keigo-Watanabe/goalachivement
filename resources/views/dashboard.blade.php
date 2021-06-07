<x-app-layout>
    <div class="my-page-main">
      @if (session('message'))
      <div class="task-show-message">
        <div class="success-message">
          @if (session('goal_title'))
            『{{ session('goal_title') }}』{{ session('message') }}
          @endif
        </div>
      </div>
      @endif

      <div class="calendar-container">
        <div class="calendar">
          <div class="calendar-title">
            <a href="/dashboard/?date={{ $prevMonth }}">< 前月</a>
            <span class="this-month">{!! $getTitle !!}</span>
            <a href="/dashboard/?date={{ $nextMonth }}">来月 ></a>
          </div>

          <div class="calendar-content">
            <table border="1" class="calendar-table">
              <thead>
                <tr>
                  <th>日</th>
                  <th>月</th>
                  <th>火</th>
                  <th>水</th>
                  <th>木</th>
                  <th>金</th>
                  <th>土</th>
                </tr>
              </thead>
              <tbody>
                {!! $getCalendar !!}
              </tbody>
            </table>
          </div>
        </div>

        <div class="calendar-schedule">
          <div class="calendar-schedule-title">
            {{ date('Y年n月j日', strtotime($date)) }}
          </div>

          <div class="calendar-schedule-task">
            <div class="calendar-schedule-task-inner">
              <div class="calendar-schedule-content">
                <ul>
                  @if ($schedules->count() == 0)
                    <div class="no-schedule">
                      予定はありません
                    </div>
                  @else
                  @foreach ($schedules as $schedule)
                    <li>
                      <span class="calendar-schedule-time">{{ date('G:i', strtotime($schedule->start_time)) }} 〜 @if ($schedule->end_time != date('Y-m-d 00:00:00', strtotime($date)) && $schedule->start_time != $schedule->end_time) {{ date('G:i', strtotime($schedule->end_time)) }} @endif</span>
                      <span class="calendar-schedule-name">{{ $schedule->content }}</span>
                    </li>
                  @endforeach
                  @endif
                </ul>

                <div class="schedule-link">
                  <a href="/schedule/?date={{ date('Y-m-d\TH:i', strtotime($day)) }}">予定の追加</a>
                </div>
              </div>

              <div class="calendar-task-content">
                <div class="calendar-task-title">
                  <h3>タスク</h3>
                </div>
                <ul>
                  @if ($tasks->count() == 0)
                    <div class="no-schedule">
                      タスクはありません
                    </div>
                  @else
                  @foreach ($tasks as $task)
                    @if ($task->complete == 0)
                      @if ($day > date('Y-m-d', strtotime($task->start_date)) && $day < date('Y-m-d', strtotime($task->end_date)))
                      <li class="task-sammary-item schedule-sammary-item">
                        <div class="task-name">
                          <a href="/task/{{ $task->task_id }}"><span class="task-content-name">{{ $task->content }}</span></a>
                        </div>

                        <div class="task-category task-category-complete">
                          @foreach ($task_categories as $task_category)
                            @if ($task_category->task_category_id == $task->task_category_id)
                            <span style="background-color: {{ $task_category->category_color }};">{{ $task_category->task_category }}</span>
                            @endif
                          @endforeach

                          <form class="complete-form" action="/task/{{ $task->task_id }}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="content" value="{{ $task->content }}">
                            <input type="submit" name="complete" value="完了">
                          </form>
                        </div>
                      </li>
                      @endif
                    @endif
                  @endforeach
                  @endif
                </ul>
              </div>
            </div>
          </div>

        </div>
      </div>

      <div class="goal-container">
        <div class="goal-title">
          <p>
            <span class="goal-proccess">目標までの道のり</span>
          </p>
        </div>

        <div class="goal-content">
          <ul>
            {!! $getGoal !!}
          </ul>
        </div>
      </div>
    </div>
</x-app-layout>
