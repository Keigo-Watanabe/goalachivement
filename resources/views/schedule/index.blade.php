<x-app-layout>
    <div class="my-page-main">

      @if ($date)
        <div class="schedule-container">
          <div class="schedule-title">
            <h2>{{ date('n月j日', strtotime($date)) }}の予定</h2>
          </div>
        </div>
      @endif
    </div>
</x-app-layout>
