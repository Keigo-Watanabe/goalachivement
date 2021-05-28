<x-app-layout>
    <div class="my-page-main">
      <div class="task-sammary">
        <div class="task-sammary-title">
          <h2>タスク一覧 日付順</h2>

          <ul>
            <li><a href="/taskcategory">カテゴリー別</a></li>
            <li id="priority-list" class="priority-list">
              優先度
              <div id="priority-list-box" class="priority-list-box">
                <ul>
                  <li><a href="/taskpriority">重要順</a></li>
                  <li><a href="/taskseverity">緊急順</a></li>
                  <li><a href="/tasktotallpriority">総合順（重要 × 緊急）</a></li>
                </ul>
              </div>
            </li>
            <li><a href="/taskcomplete">完了済</a></li>
          </ul>
        </div>

        <div class="task-sammary-content">
          <ul class="task-sammary-list">
            @foreach ($tasks as $task)
              @if ($task->complete == 0)
              <li class="task-sammary-item">
                <div class="task-name">
                  <span class="task-content-name">{{ $task->content }}</span>
                  <span class="task-dot"><i class="fas fa-ellipsis-h"></i></span>
                  <div class="task-edit-menu">
                    <a href="/task/{{ $task->task_id }}/edit">編集</a>
                    <form class="task-delete" action="/task/{{ $task->task_id }}" method="post" onsubmit="if(confirm('削除します。よろしいですか？')) { return true } else { return false }">
                      <input type="hidden" name="_method" value="DELETE">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <input type="submit" name="delete" value="削除">
                    </form>
                  </div>
                </div>

                <div class="memo">
                  <span>{{ $task->memo }}</span>
                </div>

                <div class="task-category">
                  @foreach ($task_categories as $task_category)
                    @if ($task_category->task_category_id == $task->task_category_id)
                      <span style="background-color: {{ $task_category->category_color }};">{{ $task_category->task_category }}</span>
                    @endif
                  @endforeach
                </div>

                <div class="task-term-complete">
                  <div class="task-term">
                    <i class="fas fa-calendar-alt"></i>
                    <span class="task-date">{{ date('n月j日', strtotime($task->start_date)) }}〜{{ date('n月j日', strtotime($task->end_date)) }}</span>
                  </div>

                  <form class="complete-form" action="/task/{{ $task->task_id }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT">
                    <input type="submit" name="complete" value="完了">
                  </form>
                </div>
              </li>
              @endif
            @endforeach
          </ul>
        </div>
      </div>
    </div>
</x-app-layout>
