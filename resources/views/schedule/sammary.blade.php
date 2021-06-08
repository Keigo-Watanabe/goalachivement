<x-app-layout>
    <div class="my-page-main">

      @if (session('message'))
        <div class="success-message schedule-success">
          {{ session('message') }}
        </div>
      @endif

      <div class="schedule-sammary-container">
        <div class="schedule-sammary-title">
          <h2>予定一覧 日付別</h2>

          <a href="/commonschedule">グループ別</a>
        </div>

        <div class="schedule-sammary-content">
          @foreach ($schedule_date as $date)
            <div class="schedule-date">
              {{ $date }}
            </div>
            @foreach ($schedules as $schedule)
              @if ($date == date('Y-m-d', strtotime($schedule->start_time)))
                {{ $schedule->content }}
              @endif
            @endforeach
          @endforeach
        </div>
      </div>

    </div>
</x-app-layout>
