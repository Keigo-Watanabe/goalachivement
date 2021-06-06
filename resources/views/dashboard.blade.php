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

          <div class="calendar-schedule-content">
            <ul>
              @if ($schedules->count() == 0)
                <div class="no-schedule">
                  予定はありません
                </div>
              @else
              @foreach ($schedules as $schedule)
                <li>
                  <span class="calendar-schedule-time">{{ date('G:i', strtotime($schedule->start_time)) }} 〜 @if ($schedule->end_time != date('Y-m-d 00:00:00', strtotime($date))) {{ date('G:i', strtotime($schedule->end_time)) }} @endif</span>
                  <span class="calendar-schedule-name">{{ $schedule->content }}</span>
                </li>
              @endforeach
              @endif
            </ul>
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
