@extends('layouts.contactlayout')

@section('content')
  <!-- お問い合わせファーストビュー -->
  <div class="contact-firstview">
    <div class="contact-firstview-bg">
      <div class="contact-title">
        <h2>お問い合わせ</h2>
        <div class="contact-title-sentence">
          <p>当アプリをご覧、またはご使用いただきありがとうございます。</p>
          <p>ご意見やご感想、お問い合わせ等はこちらからご連絡ください。</p>
        </div>
      </div>
    </div>
  </div>

  <!-- お問い合わせフォーム -->
  <div class="contact-container">
    <form class="contact-form" action="" method="post">
      <input class="contact-input" type="text" name="" value="" placeholder="お名前">
      <input class="contact-input" type="email" name="" value="" placeholder="メールアドレス">
      <input class="contact-input" type="text" name="" value="" placeholder="件名">
      <textarea name="" placeholder="メッセージ"></textarea>
      <button class="submit-btn" type="submit" name="">送信</button>
    </form>
  </div>
@endsection
