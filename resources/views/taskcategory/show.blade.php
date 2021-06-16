<x-app-layout>
    <div class="my-page-main">

      <div class="task-sammary">
        <div class="task-sammary-title">
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
            <div class="form-p">
              <label>色</label>
              <input class="create-input" type="color" name="category_color" list="color-list" value="{{ $taskCategory->category_color }}">
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
