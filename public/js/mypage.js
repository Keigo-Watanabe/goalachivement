/*
カテゴリー新規追加（開閉ボタン）
*/
const newCategory = document.getElementById('new-category');

if (newCategory) {
  newCategory.addEventListener('click', () => {
    const hideCategory = document.getElementById('hide-new-category');

    hideCategory.classList.add('show-new-category');
  });
}


/*
タスク優先後（開閉ボタン）
*/
const priorityList = document.getElementById('priority-list');

if (priorityList) {
  priorityList.addEventListener('click', () => {
    const priorityListBox = document.getElementById('priority-list-box');

    priorityListBox.classList.toggle('priority-list-box-show');
  });
}



/*
タスクガントチャート（現在日までスクロール）
*/
const taskChart = document.getElementById('task-chart');
const tableRow = document.getElementById('table-row').getBoundingClientRect();
const today = document.getElementById('th-today').getBoundingClientRect();

// ガントチャートの左端を取得
const tableRowRight = tableRow.left;
// 現在日の左端を取得
const todayLeft = today.left;

// 現在日からガントチャート左端までの距離を取得
const scroll = todayLeft - tableRowRight;

// 現在日までスクロール
taskChart.scrollLeft = scroll;
