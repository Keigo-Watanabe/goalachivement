<x-app-layout>
    <div class="my-page-main">

      @if (session('message'))
        <div class="success-message schedule-success">
          {{ session('message') }}
        </div>
      @endif

      <div class="schedule-create">
        @if ($errors->any())
         <div class="alert alert-danger">
           <ul>
             @foreach ($errors->all() as $error)
               <li>{{ $error }}</li>
             @endforeach
           </ul>
         </div>
        @endif
        <div class="schedule-create-title">
          <h2>予定を編集する</h2>
        </div>

        <form class="create-form schedule-create-form" action="/schedule/{{ $schedule->schedule_id }}" method="post">
          {{ csrf_field() }}
          <input type="hidden" name="_method" value="PUT">
          <div class="form-p">
            <i class="fas fa-calendar-alt"></i>予定
            <input class="create-input" type="text" name="content" value="{{ $schedule->content }}">
          </div>

          <div class="form-p">
            <i class="fas fa-share-alt"></i>共通する予定のグループ
            <select class="create-input" name="common_schedule_id">
              <option value="0">未選択</option>
              @foreach ($commonSchedules as $commonSchedule)
                <option value="{{ $commonSchedule->common_schedule_id }}" @if ($schedule->common_schedule_id == $commonSchedule->common_schedule_id) selected @endif>{{ $commonSchedule->title }}</option>
              @endforeach
            </select>
            <div class="form-block new-category-btn">
              <span id="new-category" class="new-category">または新しいグループ</span>
            </div>
            <div id="hide-new-category" class="hide-new-category">
              <input class="create-input" type="text" name="title" placeholder="グループを入力">

              <div class="color-p">
                <span class="category-color">色</span>

                <div id="color-picker" class="color-picker">
                  <div class="color-selector">
                    <input id="color-list" class="color-list" type="text" name="common_color">
                    <span id="angle-down" class="color-list-angle angle-down"><i class="fas fa-angle-down"></i></span>
                    <span id="angle-up" class="color-list-angle angle-up"><i class="fas fa-angle-up"></i></span>
                  </div>
                  <div id="color-pallet" class="color-pallet">
                    <ul>
                      <li class="color-item" style="background: #f44335;">#f44335</li>
                      <li class="color-item" style="background: #e91e63;">#e91e63</li>
                      <li class="color-item" style="background: #9c26b0;">#9c26b0</li>
                      <li class="color-item" style="background: #673bb7;">#673bb7</li>
                      <li class="color-item" style="background: #2296f3;">#2296f3</li>
                      <li class="color-item" style="background: #03a9f4;">#03a9f4</li>
                      <li class="color-item" style="background: #01bcd4;">#01bcd4</li>
                      <li class="color-item" style="background: #009688;">#009688</li>
                      <li class="color-item" style="background: #4caf50;">#4caf50</li>
                      <li class="color-item" style="background: #8bc34a;">#8bc34a</li>
                      <li class="color-item" style="background: #cddc39;">#cddc39</li>
                      <li class="color-item" style="background: #ffc108;">#ffc108</li>
                      <li class="color-item" style="background: #ff9801;">#ff9801</li>
                      <li class="color-item" style="background: #ff5722;">#ff5722</li>
                      <li class="color-item" style="background: #795548;">#795548</li>
                      <li class="color-item" style="background: #607d8b;">#607d8b</li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="form-p">
            <div class="form-block">
              <i class="fas fa-hourglass-start"></i>予定開始時間
              <input class="create-input" type="datetime-local" name="start_time" value="{{ date('Y-m-d\TH:i', strtotime($schedule->start_time)) }}">
            </div>
            <div class="form-block">
              <i class="fas fa-hourglass-end"></i>予定終了時間
              <input class="create-input" type="datetime-local" name="end_time" value="{{ date('Y-m-d\TH:i', strtotime($schedule->end_time)) }}">
            </div>
          </div>

          <div class="form-p">
            <i class="fas fa-pen"></i>メモ
            <input class="create-input" type="text" name="memo" value="{{ $schedule->memo }}">
          </div>

          <div class="form-p">
            <input class="form-submit-btn" type="submit" value="予定を変更">
          </div>
        </form>

        <form class="schedule-delete-form" action="/schedule/{{ $schedule->schedule_id }}" method="post" onsubmit="if(confirm('削除します。よろしいですか？')) { return true } else { return false }">
          <input type="hidden" name="_method" value="DELETE">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="content" value="{{ $schedule->content }}">
          <input type="submit" name="delete" value="予定を削除する">
        </form>

        <a class="back-schedule-sammary" href="/schedulesammary">予定一覧に戻る</a>
      </div>
    </div>
</x-app-layout>
