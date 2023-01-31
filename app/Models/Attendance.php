<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
       // モデルに関連付けるテーブル
    protected $table = 'attendances';
    // テーブルに関連付ける主キー
    protected $primaryKey = 'id';
    protected $fillable = ['date', 'start_time', 'end_time', 'user_id'];

    public function rests(){
        return $this->hasMany('App\Models\Rest');
    }
}
