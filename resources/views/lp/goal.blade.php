@extends('layouts.welcome')

@section('content')
  <div class="feature">
    <div id="goal" class="feature-title">
      <h2>目標を設定し、タスクを追加</h2>
    </div>

    <div class="feature-box">
      <div class="feature-image feature-image-1">
        <img src="/image/goal-sample-1.jpg" alt="goal-sample-1">
      </div>

      <div class="feature-content">
        <h3><span class="feature-number">1.</span>目標を設定</h3>
        <p>まず、目標と達成日を設定します。</p>
        <p>達成したい目標や夢などを具体的に設定しましょう。</p>
        <p>そして、達成日は「年」「月」「日」まで設定することで、より明確に道筋を立てることができます。</p>
      </div>
    </div>

    <div class="feature-box feature-box-second">
      <div class="feature-content">
        <h3><span class="feature-number">2.</span>タスクを追加</h3>
        <p>次に目標達成までの具体的なタスクを追加していきます。</p>
        <p>タスク名を記入し、共通するタスクがあればカテゴリー化します。そして、タスクを行う開始日や完了日を設定しましょう。</p>
        <p>また、タスクの「重要度」と「緊急度」を5段階で決めることで、タスクの優先度をつけることができます。</p>
      </div>

      <div class="feature-image feature-image-2">
        <img src="/image/goal-sample-2.jpg" alt="goal-sample-2">
      </div>
    </div>

    <div class="feature-box">
      <div class="feature-image feature-image-3">
        <img src="/image/goal-sample-3.jpg" alt="goal-sample-3">
      </div>

      <div class="feature-content">
        <h3><span class="feature-number">3.</span>目標達成までの道のりを管理</h3>
        <p>目標達成までのタスクを追加できたら、それを図で把握できます。</p>
        <p>現在の位置や進行状況、目標達成までの日数を確認し、1歩ずつ目標に向かって進んでいきましょう。</p>
        <p>完了したタスクは「完了」ボタンを押して、残りのタスクを把握します。</p>
      </div>
    </div>
  </div>
@endsection
