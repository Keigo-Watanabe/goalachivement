<?php

namespace App\Actions\Jetstream;

use Laravel\Jetstream\Contracts\DeletesUsers;
use App\Models\Goal;
use App\Models\Task;
use App\Models\TaskCategory;
use App\Models\Schedule;
use App\Models\CommonSchedule;
use Illuminate\Support\Facades\Auth;

class DeleteUser implements DeletesUsers
{
    /**
     * Delete the given user.
     *
     * @param  mixed  $user
     * @return void
     */
    public function delete($user)
    {
        $user_id = Auth::id();

        // 目標削除
        $goals = Goal::where('user_id', $user_id)->get();

        foreach ($goals as $goal) {
          $goal->delete();
        }

        // タスク削除
        $tasks = Task::where('user_id', $user_id)->get();

        foreach ($tasks as $task) {
          $task->delete();
        }

        // タスクカテゴリー削除
        $task_categories = TaskCategory::where('user_id', $user_id)->get();

        foreach ($task_categories as $task_category) {
          $task_category->delete();
        }

        // 予定削除
        $schedules = Schedule::where('user_id', $user_id)->get();

        foreach ($schedules as $schedule) {
          $schedule->delete();
        }

        // 予定のグループ削除
        $common_schedules = CommonSchedule::where('user_id', $user_id)->get();

        foreach ($common_schedules as $common_schedule) {
          $common_schedule->delete();
        }

        $user->deleteProfilePhoto();
        $user->tokens->each->delete();
        $user->delete();
    }
}
