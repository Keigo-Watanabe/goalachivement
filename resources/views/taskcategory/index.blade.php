<x-app-layout>
    <div class="my-page-main">

      <div class="task-sammary">
        <div class="category-sammary-title">
          <h2>カテゴリー設定</h2>
        </div>

        <div class="task-sammary-content">
          @if (session('message'))
          <div class="success-message">
            {{ session('message') }}
          </div>
          @endif

          <div class="category-sammary">
            <ul>
              @foreach ($taskCategories as $taskCategory)
                <li style="border-left: solid 0.625rem {{ $taskCategory->category_color }};">
                  {{ $taskCategory->task_category }}
                  <a href="/task_category/{{ $taskCategory->task_category_id }}">編集</a>
                </li>
              @endforeach
            </ul>
          </div>

          <div class="create-new-category">
            <div class="create-category-title">
              <h2>新しいカテゴリーを追加する</h2>
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

            <form class="category-edit-form" action="/task_category" method="post">
              {{ csrf_field() }}
              <div class="form-p">
                <label>カテゴリー名</label>
                <input class="create-input" type="text" name="task_category" value="{{ old('task_category') }}">
              </div>
              <div class="form-p">
                <label>色</label>
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
              <div class="form-p">
                <input class="form-submit-btn" type="submit" value="追加">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</x-app-layout>
