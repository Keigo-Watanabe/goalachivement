<x-app-layout>
    <div class="my-page-main">

      <div class="task-sammary">
        <div class="category-sammary-title">
          <h2>カテゴリー『{{ $taskCategory->task_category }}』の編集</h2>
        </div>

        <div class="task-sammary-content">
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

          <form class="category-edit-form" action="/task_category/{{ $taskCategory->task_category_id }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="PUT">
            <div class="form-p">
              <label>カテゴリー名</label>
              <input class="create-input" type="text" name="task_category" value="{{ $taskCategory->task_category }}">
            </div>
            <div class="form-p color-p">
              <label>色</label>

              <div id="color-picker" class="color-picker">
                <div class="color-selector">
                  <input id="color-list" class="color-list" type="text" name="category_color" value="{{ $taskCategory->category_color }}" style="background: {{ $taskCategory->category_color }};">
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
            <div class="form-p">
              <input class="form-submit-btn" type="submit" value="変更">
            </div>
          </form>

          <form class="category-delete-form" action="/task_category/{{ $taskCategory->task_category_id }}" method="post" onsubmit="if(confirm('削除します。よろしいですか？')) { return true } else { return false }">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="submit" name="delete" value="カテゴリーを削除する">
          </form>
        </div>
      </div>
    </div>
</x-app-layout>
