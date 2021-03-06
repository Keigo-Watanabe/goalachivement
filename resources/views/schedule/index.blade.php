<x-app-layout>
    <div class="my-page-main">

      @if (session('message'))
        <div class="success-message schedule-success">
          {{ session('message') }}
        </div>
      @endif

      @if ($date)
        <div class="schedule-container">
          @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif
          <div class="schedule-title">
            <h2>{{ date('n月j日', strtotime($date)) }}の予定</h2>
          </div>

          <div class="schedule-content">
            <div class="schedule-item">
              <div class="schedule-item-title">
                <h3>予定<i class="fas fa-calendar-alt"></i></h3>
              </div>
              <div class="schedule-list">
                <ul>
                  @if ($schedules->count() == 0)
                    <div class="no-schedule">
                      予定はありません
                    </div>
                  @else
                  @foreach ($schedules as $schedule)
                    <li>
                      <div class="schedule-time">
                        <i class="fas fa-clock"></i>
                        {{ date('G:i', strtotime($schedule->start_time)) }} 〜 @if ($schedule->end_time != date('Y-m-d 00:00:00', strtotime($date)) && $schedule->start_time != $schedule->end_time) {{ date('G:i', strtotime($schedule->end_time)) }} @endif
                      </div>
                      <div class="schedule-name">
                        <a href="/schedule/{{ $schedule->schedule_id }}">{{ $schedule->content }}</a>
                      </div>
                      @if ($schedule->memo != '')
                      <div class="schedule-memo">
                        {{ $schedule->memo }}
                      </div>
                      @endif
                      @if ($schedule->common_schedule_id != 0)
                      <div class="common-schedule">
                        @foreach ($commonSchedules as $commonSchedule)
                          @if ($schedule->common_schedule_id == $commonSchedule->common_schedule_id)
                            <span style="background: {{ $commonSchedule->common_color }};">{{ $commonSchedule->title }}</span>
                          @endif
                        @endforeach
                      </div>
                      @endif
                    </li>
                  @endforeach
                  @endif
                </ul>
              </div>
            </div>

            <div class="schedule-item">
              <div class="schedule-item-title">
                <h3>タスク<i class="fas fa-tasks"></i></h3>
              </div>
              <div class="schedule-list">
                <ul class="task-sammary-list">
                  @if ($tasks->count() == 0)
                    <div class="no-schedule">
                      タスクはありません
                    </div>
                  @else
                  @foreach ($tasks as $task)
                    @if ($task->complete == 0)
                      @if ($day > date('Y-m-d', strtotime($task->start_date)) && $day < date('Y-m-d', strtotime($task->end_date)))
                      <li class="task-sammary-item schedule-sammary-item">
                        <div class="task-name">
                          <a href="/task/{{ $task->task_id }}"><span class="task-content-name">{{ $task->content }}</span></a>
                        </div>

                        <div class="memo">
                          <span>{{ $task->memo }}</span>
                        </div>

                        <div class="task-category task-category-complete">
                          @foreach ($task_categories as $task_category)
                            @if ($task_category->task_category_id == $task->task_category_id)
                            <span style="background-color: {{ $task_category->category_color }};">{{ $task_category->task_category }}</span>
                            @endif
                          @endforeach

                          <form class="complete-form" action="/task/{{ $task->task_id }}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="content" value="{{ $task->content }}">
                            <input type="submit" name="complete" value="完了">
                          </form>
                        </div>
                      </li>
                      @endif
                    @endif
                  @endforeach
                  @endif
                </ul>
              </div>
            </div>
          </div>
        </div>
      @endif

      <div class="schedule-create">
        <div class="schedule-create-title">
          <h2>予定を追加する</h2>
        </div>

        <form class="create-form schedule-create-form" action="/schedule" method="post">
          {{ csrf_field() }}
          <div class="form-p">
            <i class="fas fa-calendar-alt"></i>予定
            <input class="create-input" type="text" name="content" value="{{ old('content') }}">
          </div>

          <div class="form-p">
            <i class="fas fa-share-alt"></i>共通する予定のグループ
            <select class="create-input" name="common_schedule_id">
              <option value="0">未選択</option>
              @foreach ($commonSchedules as $commonSchedule)
                <option value="{{ $commonSchedule->common_schedule_id }}" @if (old('common_schedule_id') == $commonSchedule->common_schedule_id) selected @endif>{{ $commonSchedule->title }}</option>
              @endforeach
            </select>
            <div class="form-block new-category-btn">
              <span id="new-category" class="new-category">または新しいグループ</span>
            </div>
            <div id="hide-new-category" class="hide-new-category">
              <input class="create-input" type="text" name="title" value="{{ old('title') }}">
              <span class="category-color">色</span>
              <input class="create-input" type="color" name="common_color" list="color-list" value="#f44335">
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
              <i class="fas fa-hourglass-start"></i>予定開始時間
              <input class="create-input" type="datetime-local" name="start_time" value="{{ $date }}">
            </div>
            <div class="form-block">
              <i class="fas fa-hourglass-end"></i>予定終了時間
              <input class="create-input" type="datetime-local" name="end_time" value="{{ $date }}">
            </div>
          </div>

          <div class="form-p">
            <i class="fas fa-pen"></i>メモ
            <input class="create-input" type="text" name="memo" value="{{ old('memo') }}">
          </div>

          <div class="form-p">
            <input class="form-submit-btn" type="submit" value="予定を追加">
          </div>
        </form>
      </div>
    </div>
</x-app-layout>
