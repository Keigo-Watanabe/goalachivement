/*
ヘッダー背景色
*/
const header = document.getElementById('lp-header');
const logo = document.getElementById('logo');
const navBtn = document.getElementById('header-nav');
const menuBar = document.getElementById('menu-bar');
const headerLogin = document.getElementById('header-login');

window.addEventListener('scroll', () => {
  const headerTop = window.pageYOffset;

  // ページトップから300pxを超えたら、背景色を白に変更
  if (headerTop > 300) {
    header.classList.add('lp-header-bg-white');
    logo.classList.add('header-black');
    menuBar.classList.add('bar-black');
    navBtn.classList.add('header-nav-black');
  } else {
    header.classList.remove('lp-header-bg-white');
    logo.classList.remove('header-black');
    menuBar.classList.remove('bar-black');
    navBtn.classList.remove('header-nav-black');
  }
});


/*
開閉メニュー
*/
menuBar.addEventListener('click', () => {
  // ナビゲーションとログインボタンの開閉
  navBtn.classList.toggle('close-menu');
  headerLogin.classList.toggle('close-menu');
  // メニューバーの開閉
  menuBar.classList.toggle('bar-close');
});


/*
開閉メニュー（できること）が押されたときの処理
*/
const menuLink = document.getElementById('menu-link');

menuLink.addEventListener('click', () => {
  // ナビゲーションとログインボタンを閉める
  navBtn.classList.remove('close-menu');
  headerLogin.classList.remove('close-menu');
  // メニューバーを閉める
  menuBar.classList.remove('bar-close');
});
