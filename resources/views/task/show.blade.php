<x-app-layout>
    <div class="my-page-main">

      @if (session('message'))
        <div class="task-show-message">
          <div class="success-message">
            @if (session('task_content'))
              『{{ session('task_content') }}』{{ session('message') }}
            @endif
          </div>
        </div>
      @endif

      @if ($errors->any())
        <div class="task-show-message">
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        </div>
      @endif

      <div class="task-show">
        <div class="task-show-top">
          <div class="task-show-content">
            {{ $task->content }}
          </div>
          <div class="task-show-goal">
            @foreach ($goals as $goal)
              @if ($task->goal_id == $goal->goal_id)
                <span class="task-show-item">目標</span>{{ $goal->title }}
              @endif
            @endforeach
          </div>
          <div class="task-show-category">
            @foreach ($taskCategories as $taskCategory)
              @if ($task->task_category_id == $taskCategory->task_category_id)
                <span style="background: {{ $taskCategory->category_color }};">{{ $taskCategory->task_category }}</span>
              @endif
            @endforeach
          </div>
        </div>

        <div class="task-show-bottom">
          <div class="task-show-term">
            <span class="task-show-item">期間</span>{{ date('n月j日', strtotime($task->start_date)) }}〜{{ date('n月j日', strtotime($task->end_date)) }}
          </div>
          <div class="task-show-priority">
            <span class="task-show-item">重要度</span>
            @if ($task->priority == 1)
              <span class="task-show-star">★</span>
            @elseif ($task->priority == 2)
              <span class="task-show-star">★★</span>
            @elseif ($task->priority == 3)
              <span class="task-show-star">★★★</span>
            @elseif ($task->priority == 4)
              <span class="task-show-star">★★★★</span>
            @elseif ($task->priority == 5)
              <span class="task-show-star">★★★★★</span>
            @elseif ($task->priority == 6)
              <span class="task-show-star">★★★★★★</span>
            @endif
          </div>
          <div class="task-show-priority">
            <span class="task-show-item">緊急度</span>
            @if ($task->severity == 1)
              <span class="task-show-star">★</span>
            @elseif ($task->severity == 2)
              <span class="task-show-star">★★</span>
            @elseif ($task->severity == 3)
              <span class="task-show-star">★★★</span>
            @elseif ($task->severity == 4)
              <span class="task-show-star">★★★★</span>
            @elseif ($task->severity == 5)
              <span class="task-show-star">★★★★★</span>
            @elseif ($task->severity == 6)
              <span class="task-show-star">★★★★★★</span>
            @endif
          </div>
          <div class="task-show-memo">
            {{ $task->memo }}
          </div>

          @if ($task->complete == 0)
          <form class="complete-form" action="/task/{{ $task->task_id }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="content" value="{{ $task->content }}">
            <input type="submit" name="complete" value="完了">
          </form>
          @elseif ($task->complete == 1)
          <form class="complete-form" action="/task/{{ $task->task_id }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="content" value="{{ $task->content }}">
            <input type="submit" name="uncomplete" value="完了取消">
          </form>
          @endif

          @if ($task->goal_id != 0)
            <a class="back-goal-btn" href="/goal/{{ $task->goal_id }}">目標詳細</a>
          @endif

          <form class="task-show-delete" action="/task/{{ $task->task_id }}" method="post" onsubmit="if(confirm('削除します。よろしいですか？')) { return true } else { return false }">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="content" value="{{ $task->content }}">
            <input type="submit" name="delete" value="タスクを削除する">
          </form>
        </div>
      </div>

      <div class="task-edit-content">
        <div class="task-edit-title">
          <h2>『{{ $task->content }}』の編集</h2>
        </div>
        <form class="create-form task-create-form" action="/task/{{ $task->task_id }}" method="post">
          {{ csrf_field() }}
          <input type="hidden" name="_method" value="PUT">
          <div class="form-p">
            <i class="fas fa-flag"></i>目標
            <select class="create-input" name="goal_id">
              <option value="0">未選択</option>
              @foreach ($goals as $goal)
                <option value="{{ $goal->goal_id }}" @if ($task->goal_id == $goal->goal_id) selected @endif>{{ $goal->title }}</option>
              @endforeach
            </select>
          </div>

          <div class="form-p">
            <i class="fas fa-tasks"></i>タスク
            <input class="create-input" type="text" name="content" value="{{ $task->content }}">
          </div>

          <div class="form-p">
            <i class="fas fa-calendar-check"></i>カテゴリー
            <select class="create-input" name="task_category_id">
              <option value="0">未選択</option>
              @foreach ($taskCategories as $taskCategory)
                <option value="{{ $taskCategory->task_category_id }}" @if ($task->task_category_id == $taskCategory->task_category_id) selected @endif>{{ $taskCategory->task_category }}</option>
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

          <div class="form-p">
            <div class="form-block">
              <i class="fas fa-hourglass-start"></i>開始日
              <input class="create-input" type="date" name="start_date" value="{{ $task->start_date }}">
            </div>
            <div class="form-block">
              <i class="fas fa-hourglass-end"></i>完了日
              <input class="create-input" type="date" name="end_date" value="{{ $task->end_date }}">
            </div>
          </div>

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
                <option value="0" @if ($task->priority == 0) selected @endif></option>
                <option value="1" @if ($task->priority == 1) selected @endif>★</option>
                <option value="2" @if ($task->priority == 2) selected @endif>★★</option>
                <option value="3" @if ($task->priority == 3) selected @endif>★★★</option>
                <option value="4" @if ($task->priority == 4) selected @endif>★★★★</option>
                <option value="5" @if ($task->priority == 5) selected @endif>★★★★★</option>
              </select>
            </div>
            <div class="form-block">
              <i class="fas fa-star severity"></i>緊急度
              <select class="create-input select-stars" name="severity">
                <option hidden>0 〜 ★★★★★</option>
                <option value="0" @if ($task->severity == 0) selected @endif></option>
                <option value="1" @if ($task->severity == 1) selected @endif>★</option>
                <option value="2" @if ($task->severity == 2) selected @endif>★★</option>
                <option value="3" @if ($task->severity == 3) selected @endif>★★★</option>
                <option value="4" @if ($task->severity == 4) selected @endif>★★★★</option>
                <option value="5" @if ($task->severity == 5) selected @endif>★★★★★</option>
              </select>
            </div>
          </div>

          <div class="form-p">
            <i class="fas fa-pen"></i>メモ
            <input class="create-input" type="text" name="memo" value="{{ $task->memo }}">
          </div>

          <div class="form-p">
            <input class="form-submit-btn" type="submit" value="変更">
          </div>
        </form>

        <a class="task-list-page-btn" href="/task">タスク一覧ページへ</a>
      </div>
    </div>
</x-app-layout>
