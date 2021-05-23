<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Goal;
use Carbon\Carbon;

class GoalChart
{
    protected $goal;

    function __construct($goal)
    {
        $this->goal = $goal;
    }

    // 目標のタスク（ガントチャート）
    public function goalChart()
    {
        $html = [];

        // 目標開始日
        $start_date = $this->goal->created_at;
        $start_date = new Carbon($start_date);

        // 目標達成日
        $end_date = date('Y-m-d H:i:s', strtotime($this->goal->date));
        $end_date = new Carbon($end_date);
        $end_date = $end_date->addDay(1);

        // 開始日から達成日までの日にちを繰り返し処理
        $days = [];

        while($start_date->lte($end_date)) {
          // 開始日をコピー
          $day = $start_date->copy();

          // コピーした開始日を$daysに格納
          $days[] = $day;

          // 開始日に1日追加
          $start_date->addDay(1);
        }

        foreach ($days as $day) {
          $html[] = '<th>'.date('j', strtotime($day)).'</th>';
        }

        return implode("", $html);
    }
}
