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
            {!! $getGoal !!}
          </ul>
        </div>
      </div>
    </div>
</x-app-layout>
