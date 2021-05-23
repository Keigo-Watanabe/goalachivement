<x-app-layout>
    <div class="my-page-main">
      <div class="goal-container">
        <div class="goal-title">
          <p>
            <span class="goal-proccess">目標までの道のり</span>
          </p>
        </div>

        <div class="goal-content">
          <ul>
            <li>
              <div class="goal-name">
                {{ $goal->title }}
              </div>
              <div class="goal-graph-content">
                <div class="goal-start">
                  <span class="goal-start-date">{{ date('n/j', strtotime($goal->created_at)) }}</span>
                  <i class="fas fa-campground"></i>
                </div>
                <div class="goal-graph">
                  <div class="goal-bar">
                    @if ($date > $goal->date)
                    <span class="goal-bar-inner" style="width: 100%;">
                    @else
                    <span class="goal-bar-inner" style="width: {{ $goal_percent }}%;">
                    @endif
                      <span class="goal-icon"><i class="fas fa-hiking"></i></span>
                      <span class="goal-persent-triangle"></span>
                      @if ($date > $goal->date)
                      <span class="goal-persent">100%</span>
                      @else
                      <span class="goal-persent">{{ $goal_percent }}%</span>
                      @endif
                    </span>
                  </div>
                </div>
                <div class="goal-finish">
                  <span class="goal-end-date">{{ date('n/j', strtotime($goal->date)) }}</span>
                  <i class="fas fa-mountain"></i>
                </div>
              </div>
            </li>
          </ul>

          <div class="goal-show-detail">
            <div class="goal-circle-graph">
              <div class="goal-circle">
                <!-- 360度 -->
                @if ($goal_circle_percent >= 360)
                <div class="goal-circle-inner" style="transform: rotate(180deg);">
                  <div class="goal-circle-inner-white" style="transform: rotate(-180deg); z-index: 2;"></div>
                  <div class="goal-circle-inner-red" style="transform: rotate(180deg); z-index: 3;"></div>
                <!-- 180度以上 -->
                @elseif ($goal_circle_percent >= 180)
                <div class="goal-circle-inner" style="transform: rotate(180deg);">
                  <div class="goal-circle-inner-white" style="transform: rotate(-180deg); z-index: 2;"></div>
                  <div class="goal-circle-inner-red" style="transform: rotate(360 - {{ $goal_circle_percent }}deg); z-index: 3;"></div>
                <!-- 180度未満 -->
                @else
                <div class="goal-circle-inner" style="transform: rotate({{ $goal_circle_percent }}deg);">
                  <div class="goal-circle-inner-white" style="transform: rotate(-{{ $goal_circle_percent }}deg); z-index: 2;"></div>
                  <div class="goal-circle-inner-red" style="transform: rotate(0); z-index: 1;"></div>
                @endif
                </div>
                <div class="goal-circle-percent">
                  @if ($date > $goal->date)
                  <span class="goal-circle-big-percent">100<span class="small-percent">%</span></span>
                  @else
                  <span class="goal-circle-big-percent">{{ $goal_percent }}<span class="small-percent">%</span></span>
                  @endif
                </div>
              </div>
            </div>

            <div class="goal-show-description">
              @if ($date > $goal->date)
              <p class="goal-achivement-percent">目標達成率：100%</p>
              @else
              <p class="goal-achivement-percent">目標達成率：{{ $goal_percent }}%</p>
              @endif
              <p class="now-task">現在のタスク：</p>
              @if ($goal_remaining_days < 0)
              <p class="remaining-days">目標達成！</p>
              @else
              <p class="remaining-days">目標達成まであと<span>{{ $goal_remaining_days }}日</span></p>
              @endif
            </div>
          </div>
        </div>
      </div>

      <div class="task-chart-container">
        <div class="task-list">
          <div class="task-list-title">タスク</div>
          <ul>
            @if ($tasks)
              @foreach ($tasks as $task)
                <li>{{ $task->content }}</li>
              @endforeach
            @endif
          </ul>
        </div>

        <div class="task-chart">
          <div class="task-chart-inner">
            <table>
              <thead>
                <tr>
                  {!! $goal_chart !!}
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
</x-app-layout>
