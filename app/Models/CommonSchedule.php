<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommonSchedule extends Model
{
    use HasFactory;
    use SoftDeletes;

    /*
    主キーの変更
    */
    protected $primaryKey = 'common_schedule_id';
}
