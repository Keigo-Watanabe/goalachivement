// カテゴリー新規追加（開閉ボタン）
const newCategory = document.getElementById('new-category');

newCategory.addEventListener('click', () => {
  const hideCategory = document.getElementById('hide-new-category');

  hideCategory.classList.add('show-new-category');
})
