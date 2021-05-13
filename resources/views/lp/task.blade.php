@extends('layouts.welcome')

@section('content')
  <div class="feature">
    <div id="task" class="feature-title">
      <h2>タスクを管理し、カテゴリー別に把握する</h2>
    </div>

    <div class="feature-box">
      <div class="feature-image feature-image-1">
        <img src="/image/task-sample-1.jpg" alt="task-sample-1">
      </div>

      <div class="feature-content">
        <h3><span class="feature-number">1.</span>タスクを管理</h3>
        <p>目標を達成するためのタスクや日々のタスクを管理できます。</p>
        <p>タスクを行う期間を設定し、締め切りまでに完了できるようにしましょう。</p>
        <p>また、メモしておきたいことがあれば、書き留めておくと便利です。</p>
      </div>
    </div>

    <div class="feature-box feature-box-second">
      <div class="feature-content">
        <h3><span class="feature-number">2.</span>カテゴリーごとに絞り込み</h3>
        <p>タスクにカテゴリーを追加しておけば、後にカテゴリー別で絞り込んで管理することができます。</p>
        <p>共通するタスクをカテゴリーに分けることで、よりタスクの管理が行いやすくなります。</p>
        <p>※カテゴリーの設定は任意なので、追加しなくても問題ありません。</p>
      </div>

      <div class="feature-image feature-image-2">
        <img src="/image/task-sample-2.jpg" alt="task-sample-2">
      </div>
    </div>

    <div class="feature-box">
      <div class="feature-image feature-image-3">
        <img src="/image/task-sample-3.jpg" alt="task-sample-3">
      </div>

      <div class="feature-content">
        <h3><span class="feature-number">3.</span>タスクに優先順位をつけて管理する</h3>
        <p>タスクに「重要度」と「緊急度」を5段階で設定することで、どのタスクが最も重要なのか、そして、どのタスクが最も早く完了しなければならないのか把握することができます。</p>
        <p>それぞれ「重要順」「緊急順」で並び替えると、タスクに優先順位をつけて管理できます。</p>
      </div>
    </div>
  </div>
@endsection
