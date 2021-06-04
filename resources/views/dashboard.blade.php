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

      </div>
    </div>
</x-app-layout>
