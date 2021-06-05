<x-app-layout>
    <div class="my-page-main">
      <div class="create-bg goal-bg">
        <div class="create-bg-cover">
          <h1>タスクを追加<i class="fas fa-tasks"></i></h1>
        </div>
      </div>

      <div class="create-content task-create">
        @if (session('message'))
          <div class="success-message">
            {{ session('message') }}
          </div>
        @endif
        @if ($errors->any())
         <div class="alert alert-danger">
           <ul>
             @foreach ($errors->all() as $error)
               <li>{{ $error }}</li>
             @endforeach
           </ul>
         </div>
        @endif
        <form class="create-form task-create-form" action="/task" method="post">
          {{ csrf_field() }}
          <label for=""><span class="create-step">Step1.</span>目標を選択しよう</label>
          <div class="form-p">
            <i class="fas fa-flag"></i>目標
            <select class="create-input" name="goal_id">
              <option value="0">未選択</option>
              @foreach ($goals as $goal)
                <option value="{{ $goal->goal_id }}">{{ $goal->title }}</option>
              @endforeach
            </select>
          </div>

          <label for=""><span class="create-step">Step2.</span>タスクを設定しよう</label>
          <div class="form-p">
            <i class="fas fa-tasks"></i>タスク
            <input class="create-input" type="text" name="content">
          </div>

          <label for=""><span class="create-step">Step3.</span>タスクをカテゴリーに分けよう</label>
          <div class="form-p">
            <i class="fas fa-calendar-check"></i>カテゴリー
            <select class="create-input" name="task_category_id">
              <option value="0">未選択</option>
              @foreach ($taskCategories as $taskCategory)
                <option value="{{ $taskCategory->task_category_id }}">{{ $taskCategory->task_category }}</option>
              @endforeach
            </select>
            <div class="form-block new-category-btn">
              <span id="new-category" class="new-category">または新しいカテゴリー</span>
            </div>
            <div id="hide-new-category" class="hide-new-category">
              <input class="create-input" type="text" name="task_category">
              <span class="category-color">色</span>
              <input class="create-input" type="color" name="category_color" list="color-list" value="#f44335">
              <datalist id="color-list">
                <option value="#f44335"></option>
                <option value="#e91e63"></option>
                <option value="#9c26b0"></option>
                <option value="#673bb7"></option>
                <option value="#3f51b5"></option>
                <option value="#2296f3"></option>
                <option value="#03a9f4"></option>
                <option value="#01bcd4"></option>
                <option value="#009688"></option>
                <option value="#4caf50"></option>
                <option value="#8bc34a"></option>
                <option value="#cddc39"></option>
                <option value="#ffc108"></option>
                <option value="#ff9801"></option>
                <option value="#ff5722"></option>
                <option value="#795548"></option>
                <option value="#9e9e9e"></option>
                <option value="#607d8b"></option>
              </datalist>
            </div>
          </div>

          <label for=""><span class="create-step">Step4.</span>開始日と完了日を設定しよう</label>
          <div class="form-p">
            <div class="form-block">
              <i class="fas fa-hourglass-start"></i>開始日
              <input class="create-input" type="date" name="start_date">
            </div>
            <div class="form-block">
              <i class="fas fa-hourglass-end"></i>完了日
              <input class="create-input" type="date" name="end_date">
            </div>
          </div>

          <label for=""><span class="create-step">Step5.</span>タスクの重要度と緊急度を設定しよう</label>
          <span id="matrix-description" class="matrix-description"><i class="far fa-question-circle"></i>重要度・緊急度とは？</span>
          <div id="matrix-description-content" class="matrix-description-content matrix-hide">
            <div class="matrix-image">
              <img src="/image/matrix.jpg">
            </div>

            <div class="matrix-sentence">
              <p>重要度・緊急度とは、時間管理のマトリックスを利用したタスク管理法です。</p>
              <p>マトリックスは、①重要度が高く、緊急度も高いタスク、②重要度は高いが、緊急度は低いタスク、③緊急度は高いが、重要度は低いタスク、④重要度が低く、緊急度も低いタスクの4つの領域に分けられます。</p>
              <p>タスクをこの4つの領域に分けることで、優先度を把握し、より効率的にタスクを管理できるようになります。</p>
            </div>
          </div>

          <div class="form-p">
            <div class="form-block">
              <i class="fas fa-star priority"></i>重要度
              <select class="create-input select-stars" name="priority">
                <option hidden>0 〜 ★★★★★</option>
                <option value="0"></option>
                <option value="1">★</option>
                <option value="2">★★</option>
                <option value="3">★★★</option>
                <option value="4">★★★★</option>
                <option value="5">★★★★★</option>
              </select>
            </div>
            <div class="form-block">
              <i class="fas fa-star severity"></i>緊急度
              <select class="create-input select-stars" name="severity">
                <option hidden>0 〜 ★★★★★</option>
                <option value="0"></option>
                <option value="1">★</option>
                <option value="2">★★</option>
                <option value="3">★★★</option>
                <option value="4">★★★★</option>
                <option value="5">★★★★★</option>
              </select>
            </div>
          </div>

          <label for=""><span class="create-step">Step6.</span>メモを書いておこう</label>
          <div class="form-p">
            <i class="fas fa-pen"></i>メモ
            <input class="create-input" type="text" name="memo">
          </div>

          <div class="form-p">
            <input class="form-submit-btn" type="submit" value="追加">
          </div>
        </form>

        <a class="task-list-page-btn" href="/task">タスク一覧ページへ</a>
      </div>
    </div>
</x-app-layout>
