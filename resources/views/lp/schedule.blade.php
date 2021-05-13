@extends('layouts.welcome')

@section('content')
  <div class="feature">
    <div id="schedule" class="feature-title">
      <h2>カレンダー上で予定やタスクを管理する</h2>
    </div>

    <div class="feature-box">
      <div class="feature-image feature-image-1">
        <img src="/image/schedule-sample-1.jpg" alt="schedule-sample-1">
      </div>

      <div class="feature-content">
        <h3><span class="feature-number">1.</span>予定の追加</h3>
        <p>日々の予定を追加します。</p>
        <p>共通する予定はグループ化することで、より簡単に管理できるようになります。</p>
        <p>予定の時間をしっかり決めて、管理しましょう。また、メモしておきたいことなども記入できます。</p>
      </div>
    </div>

    <div class="feature-box feature-box-second">
      <div class="feature-content">
        <h3><span class="feature-number">2.</span>カレンダー上で予定を管理</h3>
        <p>追加した予定はカレンダーに表示され、「いつ」「何の予定があるか」ひと目で把握することができます。</p>
        <p>そして、グループ化した予定は色で分けられるため、管理がしやすくなるでしょう。</p>
      </div>

      <div class="feature-image feature-image-2">
        <img src="/image/schedule-sample-2.jpg" alt="schedule-sample-2">
      </div>
    </div>

    <div class="feature-box">
      <div class="feature-image feature-image-3">
        <img src="/image/schedule-sample-3.jpg" alt="schedule-sample-3">
      </div>

      <div class="feature-content">
        <h3><span class="feature-number">3.</span>1日の予定やタスクを把握</h3>
        <p>その日の予定やタスクをより詳細に確認することができます。</p>
        <p>自分で追加した予定やタスクを随時確認し、予定をこなしていきましょう。</p>
        <p>また、予定を変更したい場合は「編集」することができます。</p>
      </div>
    </div>
  </div>
@endsection
