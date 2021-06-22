<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Goal extends Model
{
    use HasFactory;
    use SoftDeletes;

    /*
    主キーの変更
    */
    protected $primaryKey = 'goal_id';
}
