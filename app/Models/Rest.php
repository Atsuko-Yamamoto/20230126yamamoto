<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rest extends Model
{
    use HasFactory;
       // モデルに関連付けるテーブル
    protected $table = 'rests';
    // テーブルに関連付ける主キー
    protected $primaryKey = 'id';
    protected $fillable = ['start_time', 'end_time', 'attendance_id'];
}
