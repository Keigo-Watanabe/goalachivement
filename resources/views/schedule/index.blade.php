<x-app-layout>
    <div class="my-page-main">

      @if ($date)
        <div class="schedule-container">
          <div class="schedule-title">
            <h2>{{ date('n月j日', strtotime($date)) }}の予定</h2>
          </div>
        </div>
      @endif

      <div class="schedule-create">
        <div class="schedule-create-title">
          <h2>予定を追加する</h2>
        </div>

        @if ($errors->any())
         <div class="alert alert-danger">
           <ul>
             @foreach ($errors->all() as $error)
               <li>{{ $error }}</li>
             @endforeach
           </ul>
         </div>
        @endif
        <form class="create-form schedule-create-form" action="/schedule" method="post">
          {{ csrf_field() }}
          <div class="form-p">
            <i class="fas fa-calendar-alt"></i>予定
            <input class="create-input" type="text" name="content">
          </div>

          <div class="form-p">
            <i class="fas fa-share-alt"></i>共通する予定のグループ
            <select class="create-input" name="common_schedule_id">
              <option value="0">未選択</option>
            </select>
            <div class="form-block new-category-btn">
              <span id="new-category" class="new-category">または新しいグループ</span>
            </div>
            <div id="hide-new-category" class="hide-new-category">
              <input class="create-input" type="text" name="title">
              <span class="category-color">色</span>
              <input class="create-input" type="color" name="common_color" list="color-list" value="#f44335">
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

          <div class="form-p">
            <div class="form-block">
              <i class="fas fa-hourglass-start"></i>予定開始時間
              <input class="create-input" type="datetime-local" name="start_time">
            </div>
            <div class="form-block">
              <i class="fas fa-hourglass-end"></i>予定終了時間
              <input class="create-input" type="datetime-local" name="end_time">
            </div>
          </div>

          <div class="form-p">
            <i class="fas fa-pen"></i>メモ
            <input class="create-input" type="text" name="memo">
          </div>

          <div class="form-p">
            <input class="form-submit-btn" type="submit" value="予定を追加">
          </div>
        </form>
      </div>
    </div>
</x-app-layout>
