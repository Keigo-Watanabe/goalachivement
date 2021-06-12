@extends('layouts.welcome')

@section('content')

  <!-- お問い合わせフォーム -->
  <div class="contact-container">
    <div class="contact-inner">
      <div class="contact-title">
        <h2>お問い合わせ</h2>
        <div class="contact-title-sentence">
          <p>当アプリをご覧、またはご使用いただきありがとうございます。</p>
          <p>ご意見やご感想、お問い合わせ等はこちらからご連絡ください。</p>
        </div>
      </div>
      <form class="contact-form" action="https://docs.google.com/forms/u/0/d/e/1FAIpQLScnFRx_u0mocj-Ea93Ff8uhrI-k3HZjGFHVqlmRV3FIhj-D_w/formResponse" method="post" target="hidden_iframe" onsubmit="submitted=true;">
        <p>
          <label>お名前</label>
          <input class="contact-input" type="text" name="entry.1472469240" value="">
        </p>
        <p>
          <label>メールアドレス</label>
          <input class="contact-input" type="email" name="entry.954343322" value="">
        </p>
        <p>
          <label>件名</label>
          <input class="contact-input" type="text" name="entry.1316688407" value="">
        </p>
        <p>
          <label>お問い合わせ内容</label>
          <textarea class="contact-textarea" name="entry.1670279904"></textarea>
        </p>
        <p>
          <button class="contact-submit-btn" type="submit">送信</button>
        </p>
      </form>
      <script type="text/javascript">
        var submitted = false;
      </script>
      <iframe name="hidden_iframe" id="hidden_iframe" style="display: none;" onload="if (submitted) { window.location='/lp/thanks'; }"></iframe>
    </div>
  </div>

@endsection
