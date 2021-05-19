<x-app-layout>
    <div class="my-page-main">
      <div class="create-bg goal-bg">
        <div class="create-bg-cover">
          <h1>目標設定<i class="fas fa-flag"></i></h1>
        </div>
      </div>

      <div class="create-content goal-create">
        <form class="create-form goal-create-form" action="/goal" method="post">
          {{ csrf_field() }}
          <label for=""><span class="create-step">Step1.</span>目標を設定しよう</label>
          <p>
            <i class="fas fa-flag"></i>目標
            <input class="create-input" type="text" name="title" value="">
          </p>
          <label for=""><span class="create-step">Step2.</span>達成日を決めよう</label>
          <p>
            <i class="fas fa-calendar-alt"></i>達成日
            <input class="create-input" type="date" name="date" value="">
          </p>
          <p>
            <input class="form-submit-btn" type="submit" value="設定">
          </p>
        </form>
      </div>
    </div>
</x-app-layout>
