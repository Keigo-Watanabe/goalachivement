@extends('layouts.welcome')

@section('content')

  <!-- ファーストビュー -->
  <div class="firstview">
    <div class="firstview-inner">
      <div class="firstview-image">
        <img src="/image/goalachivement.png">
      </div>

      <div class="firstview-title">
        <h1>
          <span class="goalachivement-jp">目標達成</span>
          <span class="goalachivement-en">Goal Achivement</span>
        </h1>

        <a class="firstview-start start-btn" href="">はじめる</a>
      </div>
    </div>
  </div>


  <!-- アプリ説明 -->
  <div class="app-description">
    <div class="app-description-inner">
      <div class="app-description-title">
        <h2>目標達成までのタスクや日々の予定を一括管理</h2>
      </div>

      <div class="app-description-p">
        <p>目標を達成したい、けどタスクを管理しきれない･･･。そんな悩みはありませんか？</p>
        <p>「目標達成」では、目標を設定し、必要なタスクや期間を追加することで達成までの道のりを把握することができます。</p>
        <p>タスクはカテゴリーや優先度に分けて設定できるので、より簡単に、そして効率的に管理を行うことが可能です。</p>
        <p>目標を達成し、夢を実現させましょう！</p>
      </div>
    </div>
  </div>


  <!-- アプリの使い方 -->
  <div class="app-management">
    <div class="app-management-inner">
      <div class="app-management-title">
        <h2>アプリの使い方</h2>
      </div>

      <div class="app-management-container">
        <!-- ステップ1 -->
        <div class="app-management-content app-management-odd">
          <div class="app-management-image">
            <img src="/image/goal.png">
          </div>

          <div class="app-management-description">
            <div class="steps-title">
              <h3>
                <span class="app-step">Step1.</span>
                <span class="step-title-name">目標を設定</span>
              </h3>
            </div>

            <div class="app-management-description-p">
              <p>達成したい目標や夢を設定します。そして、その目標を達成する日を設定することができます。</p>
              <p>より具体的な日付を設定することで、目標達成までの期間が明確になります。</p>
            </div>
          </div>
        </div>

        <!-- ステップ2 -->
        <div class="app-management-content app-management-even">
          <div class="app-management-description">
            <div class="steps-title">
              <h3>
                <span class="app-step">Step2.</span>
                <span class="step-title-name">タスクを追加</span>
              </h3>
            </div>

            <div class="app-management-description-p">
              <p>目標を達成するために必要なタスクを設定します。タスクを行う期間を指定し、カテゴリーに分けることができます。</p>
              <p>また、タスクの優先度を把握するために、重要度と緊急度を5段階で設定します。</p>
            </div>
          </div>

          <div class="app-management-image">
            <img src="/image/task.png">
          </div>
        </div>

        <!-- ステップ3 -->
        <div class="app-management-content app-management-odd">
          <div class="app-management-image">
            <img src="/image/process.png">
          </div>

          <div class="app-management-description">
            <div class="steps-title">
              <h3>
                <span class="app-step">Step3.</span>
                <span class="step-title-name">目標達成までの道のりを確認</span>
              </h3>
            </div>

            <div class="app-management-description-p">
              <p>目標にタスクを追加していくと、目標達成までの道のりや進行状況をひと目で把握することができます。</p>
              <p>タスクを1つ1つクリアし、目標達成まで近づくことができるでしょう。</p>
            </div>
          </div>
        </div>

        <!-- ステップ4 -->
        <div class="app-management-content app-management-even">
          <div class="app-management-description">
            <div class="steps-title">
              <h3>
                <span class="app-step">Step4.</span>
                <span class="step-title-name">タスクをカテゴリー別に管理</span>
              </h3>
            </div>

            <div class="app-management-description-p">
              <p>追加したタスクはカテゴリー別に管理することができます。</p>
              <p>カテゴリーに分けることで、共通のタスクを把握することが可能です。</p>
            </div>
          </div>

          <div class="app-management-image">
            <img src="/image/category.png">
          </div>
        </div>

        <!-- ステップ5 -->
        <div class="app-management-content app-management-odd">
          <div class="app-management-image">
            <img src="/image/priority.png">
          </div>

          <div class="app-management-description">
            <div class="steps-title">
              <h3>
                <span class="app-step">Step5.</span>
                <span class="step-title-name">優先順をつけて把握</span>
              </h3>
            </div>

            <div class="app-management-description-p">
              <p>タスクに設定した重要度と緊急度で優先順位をつけます。</p>
              <p>タスクの優先順位を把握できると、よりタスクをこなしやすくなります。</p>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>


  <!-- 機能 -->
  <div class="app-feature">
    <div class="app-feature-bg">
      <div class="app-feature-inner">
        <div class="app-feature-title">
          <h2>他にも様々な機能が利用可能です</h2>
        </div>

        <div class="app-feature-container">
          <div class="app-feature-content">
            <div class="app-feature-image">
              <img src="/image/calendar.png">
            </div>

            <div class="app-feature-description">
              <h3>カレンダー</h3>
              <p>カレンダー機能を使って日々の予定や習慣をメモすることができます。</p>
            </div>
          </div>

          <div class="app-feature-content">
            <div class="app-feature-image">
              <img src="/image/schedule.png">
            </div>

            <div class="app-feature-description">
              <h3>スケジュール管理</h3>
              <p>その日の予定やタスクを一括で管理し、より効率的に行動できます。</p>
            </div>
          </div>

          <div class="app-feature-content">
            <div class="app-feature-image">
              <img src="/image/group.png">
            </div>

            <div class="app-feature-description">
              <h3>予定のグループ化</h3>
              <p>共通する予定はグループ化しておくことで、まとめて把握することができます。</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- 目標を達成しましょう -->
  <div class="start-app">
    <h2>目標を達成しましょう</h2>
    <a href="start-app-btn start-btn">はじめよう</a>
  </div>
  <!-- <div class="about-app">
    <span class="about-app-title fade-in-target">目標達成までのタスクを管理。</span>
    <span class="about-app-title fade-in-target">×</span>
    <span class="about-app-title fade-in-target">カレンダーで予定を把握。</span>

    <div class="about-app-sentence fade-in-target">
      <p>目標を設定し、それを達成するためのタスクを追加することで、目標達成までの道のりを把握することができます。</p>
      <p>それぞれのタスクに、重要度・緊急度をつけてタスクの優先度を設定しましょう。</p>
      <p>また、日常の予定も把握することで、毎日のタスクを管理することができます。</p>
      <p>目標を明確にし、タスクを1つずつこなし、夢を叶えよう。</p>
    </div>
  </div> -->

  <!-- できること -->
  <!-- <div class="feature">
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
  </div> -->

@endsection
