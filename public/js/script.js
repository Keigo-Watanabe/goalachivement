/*
ロード（フェードイン）
*/
const loadviewTitle = document.getElementById('loadview-title');
const loadview = document.getElementById('loadview');
const firstviewImage = document.getElementById('firstview-image');
const firstviewTitle = document.getElementById('firstview-title');

if (loadviewTitle) {
  const loadFadeIn = function() {
    loadviewTitle.classList.add('loadview-title-show');
    loadview.classList.add('loadview-out');
    firstviewImage.classList.add('firstview-show');
    firstviewTitle.classList.add('firstview-show');
  }

  setTimeout(loadFadeIn, 500);
}

// ロード（フェードアウト）
if (loadviewTitle) {
  const loadFadeOut = function() {
    loadviewTitle.classList.remove('loadview-title-show');
  }

  setTimeout(loadFadeOut, 1500);
}


// ヘッダーナビゲーション開閉ボタン（レスポンシブ）
const headerNavBtn = document.getElementById('header-nav-btn');
const headerNav = document.getElementById('header-nav');

if (headerNavBtn) {
  headerNavBtn.addEventListener('click', () => {
    headerNav.classList.toggle('header-nav-show');
  });
}

let navBtn = document.querySelectorAll('a[href^="#"]');

for (let i = 0; i < navBtn.length; i++) {
  navBtn[i].addEventListener('click', () => {
    headerNav.classList.remove('header-nav-show');
  });
}


// スクロールアニメーション（フェードイン）
const fadeInTarget = document.querySelectorAll('.fade-in-target');

window.addEventListener('scroll', () => {
  for (let i = 0; i < fadeInTarget.length; i++) {
    const rect = fadeInTarget[i].getBoundingClientRect().top;

    const scroll = window.pageYOffset || document.documentElement.scrollTop;

    const offset = rect + scroll;

    const windowHeight = window.innerHeight / 1.5;

    if (scroll > offset - windowHeight) {
      fadeInTarget[i].classList.add('scroll-in');
    }
  }
});


// スクロールアニメーション（矢印）
const arrowShow = document.querySelectorAll('.arrow-show');

window.addEventListener('scroll', () => {
  for (let i = 0; i < arrowShow.length; i++) {
    const rect = arrowShow[i].getBoundingClientRect().top;

    const scroll = window.pageYOffset || document.documentElement.scrollTop;

    const offset = rect + scroll;

    const windowHeight = window.innerHeight / 1.5;

    if (scroll > offset - windowHeight) {
      arrowShow[i].classList.add('odd-arrow-show');
      arrowShow[i].classList.add('even-arrow-show');
    }
  }
});


// スムーススクロール（jQuery）
$(function(){

  $('a[href^="#"]').click(function() {
    let href = $(this).attr("href");
    let target = $(href == "#" || href == "" ? 'html' : href);
    let position = target.offset().top;

    $('body, html').animate({
      scrollTop: position
    }, 500, 'swing');
    return false;
  });

});
