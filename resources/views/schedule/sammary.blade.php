<x-app-layout>
    <div class="my-page-main">

      @if (session('message'))
        <div class="success-message schedule-success">
          @if (session('schedule_content'))
            『{{ session('schedule_content') }}』{{ session('message') }}
          @else
            {{ session('message') }}
          @endif
        </div>
      @endif

      <div class="schedule-sammary-container">
        <div class="schedule-sammary-title">
          <h2>予定一覧 日付別</h2>

          <a href="/commonschedule">グループ別</a>
        </div>

        <div class="schedule-sammary-content">
          @if ($schedule_date == null)
            <div class="no-schedule">
              予定はありません
            </div>
          @else
          @foreach ($schedule_date as $date)
            @if ($date >= $day)
            <div class="schedule-date-sammary">
              <div class="schedule-date">
                {{ date('n月j日', strtotime($date)) }}
              </div>
              <ul>
                @foreach ($schedules as $schedule)
                  @if ($date == date('Y-m-d', strtotime($schedule->start_time)))
                  <li>
                    <div class="schedule-time">
                      <i class="fas fa-clock"></i>
                      {{ date('G:i', strtotime($schedule->start_time)) }} 〜 @if ($schedule->end_time != date('Y-m-d 00:00:00', strtotime($date)) && $schedule->start_time != $schedule->end_time) {{ date('G:i', strtotime($schedule->end_time)) }} @endif
                    </div>
                    <div class="schedule-name">
                      <a href="/schedule/{{ $schedule->schedule_id }}">{{ $schedule->content }}</a>
                    </div>
                    @if ($schedule->memo != '')
                    <div class="schedule-memo">
                      {{ $schedule->memo }}
                    </div>
                    @endif
                    @if ($schedule->common_schedule_id != 0)
                    <div class="common-schedule">
                      @foreach ($commonSchedules as $commonSchedule)
                        @if ($schedule->common_schedule_id == $commonSchedule->common_schedule_id)
                          <span style="background: {{ $commonSchedule->common_color }};">{{ $commonSchedule->title }}</span>
                        @endif
                      @endforeach
                    </div>
                    @endif
                  </li>
                  @endif
                @endforeach
              </ul>
            </div>
            @endif
          @endforeach
          @endif
        </div>
      </div>

    </div>
</x-app-layout>
