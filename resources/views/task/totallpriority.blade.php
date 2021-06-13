<x-app-layout>
    <div class="my-page-main">
      <div class="task-sammary">
        <div class="task-sammary-title">
          <h2>タスク一覧 総合優先度</h2>

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

        <div class="table-matrix">
          <div class="table-matrix-top">
            <div class="matrix-priority-high">
              <div class="matrix-th matrix-th-vertical">重要度<span class="matrix-high priority-side">高</span></div>
            </div>

            <div class="high-priority-task">
              <div class="matrix-one matrix-box">
                <div class="matrix-title">重要かつ緊急</div>
                <!-- レスポンシブ -->
                <div class="matrix-responsive">
                  <div class="matrix-priority-level">
                    <span class="priority-level">重要度：高</span>
                    <span class="severity-level">緊急度：高</span>
                  </div>
                  <div class="matrix-task-count">
                    タスク：{{ $matrix_a_count }}
                  </div>
                  <div class="matrix-number matrix-1">
                    <span>1</span>
                  </div>
                </div>
                <ul>
                  @if ($matrix_a_count == 0)
                    <div class="no-task-matrix">
                      タスクはありません
                    </div>
                  @else
                  @foreach ($tasks as $task)
                    @if ($task->priority >= 3 && $task->severity >= 3)
                    <li class="task-sammary-item matrix-item">
                      <div class="task-name">
                        <a href="/task/{{ $task->task_id }}"><span class="task-content-name">{{ $task->content }}</span></a>
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
                          <input type="hidden" name="content" value="{{ $task->content }}">
                          <input type="submit" name="complete" value="完了">
                        </form>
                      </div>
                    </li>
                    @endif
                  @endforeach
                  @endif
                </ul>
              </div>

              <div class="matrix-two matrix-box">
                <div class="matrix-title">重要だが緊急でない</div>
                <!-- レスポンシブ -->
                <div class="matrix-responsive">
                  <div class="matrix-priority-level">
                    <span class="priority-level">重要度：高</span>
                    <span class="severity-level">緊急度：低</span>
                  </div>
                  <div class="matrix-task-count">
                    タスク：{{ $matrix_b_count }}
                  </div>
                  <div class="matrix-number matrix-2">
                    <span>2</span>
                  </div>
                </div>
                <ul>
                  @if ($matrix_b_count == 0)
                    <div class="no-task-matrix">
                      タスクはありません
                    </div>
                  @else
                  @foreach ($tasks as $task)
                    @if ($task->priority >= 3 && $task->severity < 3)
                    <li class="task-sammary-item matrix-item">
                      <div class="task-name">
                        <a href="/task/{{ $task->task_id }}"><span class="task-content-name">{{ $task->content }}</span></a>
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
                          <input type="hidden" name="content" value="{{ $task->content }}">
                          <input type="submit" name="complete" value="完了">
                        </form>
                      </div>
                    </li>
                    @endif
                  @endforeach
                  @endif
                </ul>
              </div>
            </div>
          </div>

          <div class="table-matrix-bottom">
            <div class="matrix-priority-high">
              <div class="matrix-th matrix-th-vertical">重要度<span class="matrix-low priority-side">低</span></div>
            </div>

            <div class="low-priority-task">
              <div class="matrix-three matrix-box">
                <div class="matrix-title">緊急だが重要でない</div>
                <!-- レスポンシブ -->
                <div class="matrix-responsive">
                  <div class="matrix-priority-level">
                    <span class="priority-level">重要度：低</span>
                    <span class="severity-level">緊急度：高</span>
                  </div>
                  <div class="matrix-task-count">
                    タスク：{{ $matrix_c_count }}
                  </div>
                  <div class="matrix-number matrix-3">
                    <span>3</span>
                  </div>
                </div>
                <ul>
                  @if ($matrix_c_count == 0)
                    <div class="no-task-matrix">
                      タスクはありません
                    </div>
                  @else
                  @foreach ($tasks as $task)
                    @if ($task->priority < 3 && $task->severity >= 3)
                    <li class="task-sammary-item matrix-item">
                      <div class="task-name">
                        <a href="/task/{{ $task->task_id }}"><span class="task-content-name">{{ $task->content }}</span></a>
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
                          <input type="hidden" name="content" value="{{ $task->content }}">
                          <input type="submit" name="complete" value="完了">
                        </form>
                      </div>
                    </li>
                    @endif
                  @endforeach
                  @endif
                </ul>
              </div>

              <div class="matrix-four matrix-box">
                <div class="matrix-title">重要でも緊急でもない</div>
                <!-- レスポンシブ -->
                <div class="matrix-responsive">
                  <div class="matrix-priority-level">
                    <span class="priority-level">重要度：低</span>
                    <span class="severity-level">緊急度：低</span>
                  </div>
                  <div class="matrix-task-count">
                    タスク：{{ $matrix_d_count }}
                  </div>
                  <div class="matrix-number matrix-4">
                    <span>4</span>
                  </div>
                </div>
                <ul>
                  @if ($matrix_d_count == 0)
                    <div class="no-task-matrix">
                      タスクはありません
                    </div>
                  @else
                  @foreach ($tasks as $task)
                    @if ($task->priority < 3 && $task->severity < 3)
                    <li class="task-sammary-item matrix-item">
                      <div class="task-name">
                        <a href="/task/{{ $task->task_id }}"><span class="task-content-name">{{ $task->content }}</span></a>
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
                          <input type="hidden" name="content" value="{{ $task->content }}">
                          <input type="submit" name="complete" value="完了">
                        </form>
                      </div>
                    </li>
                    @endif
                  @endforeach
                  @endif
                </ul>
              </div>
            </div>
          </div>

          <div class="table-matrix-bottom matrix-severity-bottom">
            <div class="matrix-priority-low"><span class="matrix-space">/</span></div>
            <div class="low-priority-task">
              <div class="matrix-severity-high">
                <div class="matrix-th matrix-th-row">緊急度<span class="matrix-high severity-side">高</span></div>
              </div>

              <div class="matrix-severity-low">
                <div class="matrix-th matrix-th-row">緊急度<span class="matrix-low severity-side">低</span></div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
</x-app-layout>
