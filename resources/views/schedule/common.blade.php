<x-app-layout>
    <div class="my-page-main">

      @if (session('message'))
        <div class="success-message schedule-success">
          {{ session('message') }}
        </div>
      @endif

      <div class="schedule-sammary-container">
        <div class="schedule-sammary-title">
          <h2>予定一覧 グループ別</h2>

          <a href="/commonschedule">グループ別</a>
        </div>

        <div class="schedule-sammary-content">
          @foreach ($commonSchedules as $commonSchedule)
            <div class="schedule-date-sammary common-schedule-sammary">
              <div class="common-schedule-title">
                <div class="common-schedule-color" style="background: {{ $commonSchedule->common_color }};"></div>
                <div class="common-schedule-name">
                  {{ $commonSchedule->title }}
                </div>
              </div>
              <ul>
                @foreach ($schedules as $schedule)
                  @if ($schedule->common_schedule_id == $commonSchedule->common_schedule_id)
                    @if ($schedule->start_time >= $day)
                    <li>
                      <div class="schedule-time">
                        <i class="fas fa-clock"></i>
                        {{ date('n月j日', strtotime($schedule->start_time)) }}
                        {{ date('G:i', strtotime($schedule->start_time)) }} 〜 @if ($schedule->end_time != date('Y-m-d 00:00:00', strtotime($schedule->end_time)) && $schedule->start_time != $schedule->end_time) {{ date('G:i', strtotime($schedule->end_time)) }} @endif
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
                        <span style="background: {{ $commonSchedule->common_color }};">{{ $commonSchedule->title }}</span>
                      </div>
                      @endif
                    </li>
                    @endif
                  @endif
                @endforeach
              </ul>
            </div>
          @endforeach
        </div>
      </div>

    </div>
</x-app-layout>
