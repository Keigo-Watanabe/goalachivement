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
ヘッダー（レスポンシブ）
*/
const header = document.getElementById('my-page-header');
const hamburgerBtn = document.getElementById('hamburger-btn')

if (hamburgerBtn) {
  hamburgerBtn.addEventListener('click', () => {
    header.classList.toggle('my-page-header-block');
  });
}


/*
ヘッダーメニュー・タスク（開閉ボタン）
*/
const taskBtn = document.getElementById('task-btn');

if (taskBtn) {
  taskBtn.addEventListener('click', () => {
    const taskNavMenu = document.getElementById('task-nav-menu');

    taskNavMenu.classList.toggle('task-nav-menu-show');
  });
}


/*
ヘッダーメニュー・予定（開閉ボタン）
*/
const scheduleBtn = document.getElementById('schedule-btn');

if (scheduleBtn) {
  scheduleBtn.addEventListener('click', () => {
    const scheduleNavMenu = document.getElementById('schedule-nav-menu');

    scheduleNavMenu.classList.toggle('schedule-nav-menu-show');
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
タスクカテゴリー一覧
*/
let taskCategoryBox = document.querySelectorAll('.task-category-box');

if (taskCategoryBox) {
  for (let i = 0; i < taskCategoryBox.length; i++) {
    let each_taskCategoryBox = taskCategoryBox[i];
    let item = each_taskCategoryBox.lastElementChild;

    let itemList = item.childElementCount;

    // タスクリストの数が0の場合はカテゴリーを非表示
    if (itemList == 0) {
      let parentBox = item.parentNode;
      parentBox.style.display = 'none';
    }
  }
}


/*
重要度・緊急度の説明
*/
const matrixDescription = document.getElementById('matrix-description');

if (matrixDescription) {
  const matrixDescriptionContent = document.getElementById('matrix-description-content');

  matrixDescription.addEventListener('mouseover', () => {
    matrixDescriptionContent.classList.remove('matrix-hide');
  });

  matrixDescriptionContent.addEventListener('mouseleave', () => {
    matrixDescriptionContent.classList.add('matrix-hide');
  });
}


/*
予定グループ別一覧
*/
let commonScheduleSammary = document.querySelectorAll('.common-schedule-sammary');

if (commonScheduleSammary) {
  for (let i = 0; i < commonScheduleSammary.length; i++) {
    let each_commonScheduleSammary = commonScheduleSammary[i];
    let item = each_commonScheduleSammary.lastElementChild;

    let itemList = item.childElementCount;

    // 予定の数が0の場合はグループを非表示
    if (itemList == 0) {
      let parentBox = item.parentNode;
      parentBox.style.display = 'none';
    }
  }
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
