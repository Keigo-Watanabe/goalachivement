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
          <div class="form-p">
            <i class="fas fa-flag"></i>目標
            <input class="create-input" type="text" name="title" value="">
          </div>
          <label for=""><span class="create-step">Step2.</span>達成日を決めよう</label>
          <div class="form-p">
            <i class="fas fa-calendar-alt"></i>達成日
            <input class="create-input" type="date" name="date" value="">
          </div>
          <div class="form-p">
            <input class="form-submit-btn" type="submit" value="設定">
          </div>
        </form>
      </div>
    </div>
</x-app-layout>
