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
            @foreach ($goals as $goal)
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
                      <span class="goal-bar-inner">
                        <span class="goal-icon"><i class="fas fa-hiking"></i></span>
                        <span class="goal-persent-triangle"></span>
                        <span class="goal-persent">50%</span>
                      </span>
                    </div>
                  </div>
                  <div class="goal-finish">
                    <span class="goal-end-date">{{ date('n/j', strtotime($goal->date)) }}</span>
                    <i class="fas fa-mountain"></i>
                  </div>
                </div>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
</x-app-layout>
