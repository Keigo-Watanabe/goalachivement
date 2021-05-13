@extends('layouts.welcome')

@section('content')

  <!-- アプリ説明 -->
  <div class="about-app">
    <span class="about-app-title fade-in-target">目標達成までのタスクを管理。</span>
    <span class="about-app-title fade-in-target">×</span>
    <span class="about-app-title fade-in-target">カレンダーで予定を把握。</span>

    <div class="about-app-sentence fade-in-target">
      <p>目標を設定し、それを達成するためのタスクを追加することで、目標達成までの道のりを把握することができます。</p>
      <p>それぞれのタスクに、重要度・緊急度をつけてタスクの優先度を設定しましょう。</p>
      <p>また、日常の予定も把握することで、毎日のタスクを管理することができます。</p>
      <p>目標を明確にし、タスクを1つずつこなし、夢を叶えよう。</p>
    </div>
  </div>

  <!-- できること -->
  <div class="feature">
    <div id="feature" class="feature-title">
      <h2>できること</h2>
    </div>

    <div class="feature-box">
      <div class="feature-image feature-image-1">
        <img class="fade-in-target" src="/image/lp-sample-1.jpg" alt="lp-sample-1">
      </div>

      <div class="feature-content">
        <h3><span class="feature-number">1.</span>目標を設定し、タスクを追加</h3>
        <p>まず、目標と達成する日を設定します。</p>
        <p>達成日に合わせて、必要なタスクを追加し、それぞれの完了日を設定しましょう。</p>
        <p>タスクの設定ができれば、目標達成までの道のりをひと目で把握することができます。</p>
        <a href="{{ url('lp/goal#goal') }}">詳細はこちら</a>
      </div>
    </div>

    <div class="feature-box feature-box-second">
      <div class="feature-content">
        <h3><span class="feature-number">2.</span>タスクを管理し、カテゴリー別に把握する</h3>
        <p>目標達成までのタスクとは別に、個々のタスクを設定できます。</p>
        <p>そして、共通するタスクはカテゴリー化して管理しましょう。</p>
        <p>カテゴリー別に絞り込めば、管理がしやすくなります。</p>
        <a href="{{ url('lp/task#task') }}">詳細はこちら</a>
      </div>

      <div class="feature-image feature-image-2">
        <img class="fade-in-target" src="/image/lp-sample-2.jpg" alt="lp-sample-2">
      </div>
    </div>

    <div class="feature-box">
      <div class="feature-image feature-image-3">
        <img class="fade-in-target" src="/image/lp-sample-3.jpg" alt="lp-sample-3">
      </div>

      <div class="feature-content">
        <h3><span class="feature-number">3.</span>カレンダー上で予定やタスクを管理する</h3>
        <p>日常の予定や習慣化したいことをカレンダーに登録できます。</p>
        <p>関連のある予定はグループ化することで、さらに予定の管理がしやすくなります。</p>
        <p>また、タスクをカレンダー上でも管理することが可能です。</p>
        <a href="{{ url('lp/schedule#schedule') }}">詳細はこちら</a>
      </div>
    </div>
  </div>

@endsection
