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
                    <span class="goal-bar-inner" style="width: {{ $sum }}%;">
                      <span class="goal-icon"><i class="fas fa-hiking"></i></span>
                      <span class="goal-persent-triangle"></span>
                      <span class="goal-persent">{{ $sum }}%</span>
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
                @elseif ($goal_circle_percent >= 181)
                <div class="goal-circle-inner" style="transform: rotate(180deg);">
                  <div class="goal-circle-inner-white" style="transform: rotate(-180deg); z-index: 2;"></div>
                  <div class="goal-circle-inner-red" style="transform: rotate({{ $mul }}deg); z-index: 3;"></div>
                <!-- 0度 -->
                @elseif ($sum == 0)
                <div class="goal-circle-inner" style="transform: rotate(0);">
                  <div class="goal-circle-inner-white" style="transform: rotate(0); z-index: 2;"></div>
                <!-- 180度未満 -->
                @else
                <div class="goal-circle-inner" style="transform: rotate({{ $goal_circle_percent }}deg);">
                  <div class="goal-circle-inner-white" style="transform: rotate(-{{ $goal_circle_percent }}deg); z-index: 2;"></div>
                  <div class="goal-circle-inner-red" style="transform: rotate(0); z-index: 1;"></div>
                @endif
                </div>
                <div class="goal-circle-percent">
                  <span class="goal-circle-big-percent">{{ $sum }}<span class="small-percent">%</span></span>
                </div>
              </div>
            </div>

            <div class="goal-show-description">
              <p class="goal-achivement-percent">目標達成率：{{ $sum }}%</p>
              @if ($sum == 100)
              <p class="remaining-days">目標達成！</p>
              @elseif ($goal_remaining_days < 0)
              <p class="remaining-days">目標達成まであと<span>0日</span></p>
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
                <li>
                  @if ($task->complete == 1)
                    <i class="fas fa-check-circle"></i><span style="color: #898989;"><a href="/task/{{ $task->task_id }}">{{ $task->content }}</a></span>
                  @else
                    <i class="far fa-circle"></i><a href="/task/{{ $task->task_id }}">{{ $task->content }}</a>
                  @endif
                </li>
              @endforeach
            @endif
          </ul>
        </div>

        <div id="task-chart" class="task-chart">
          <div class="task-chart-inner">
            <div class="table">
              <div class="thead">
                <div id="table-row" class="table-row">
                  {!! $goal_chart !!}
                </div>
              </div>
              <div class="tbody">
                {!! $task_chart !!}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</x-app-layout>
