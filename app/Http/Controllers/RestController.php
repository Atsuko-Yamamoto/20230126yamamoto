<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Rest;
use App\Models\Attendance;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class State
{
  public const NOT_WORK = 0;
  public const WORKING = 1;
  public const RESTING = 2;
}

class RestController extends Controller
{

  public function outputLogFacade() {
        // Log::emergency("emergency ログ!");
        Log::alert("alert ログ!");
        // Log::critical("critical ログ!");
        // Log::error("error ログ!");
        Log::warning("warning ログ!");
        Log::notice("notice ログ!");
        // Log::info("info ログ!");
        Log::debug("debug ログ!");
  }

  // 日を跨いだ時の前日データ閉じて、当日のレコード作り直す処理
  private function close()
  {
    $attendance = Attendance::where('user_id', $user_id)->where('date', new Carbon('yesterday'))->whereNull('end_time')->get()->first();
    if(!$attendance->isEmpty()) {

      $attendance->end_time = Carbon::endOfDay();
      $attendance->save(); 
      Attendance::create(['user_id' => $user_id,
                          'date' => new Carbon('today'),
                          'start_time' => Carbon::startOfDay()]);

      $rest = $attendance->rests()->whereNull('end_time')->get()->first();
      if(!$rest->isEmpty()) {
        $rest_end = Carbon::now();

        $rest->end_time = Carbon::endOfDay();
        $rest->save();
      }
    }
  }

  public function index()
  {
    global $date, $work_start, $rest_start;
    $btn_state = [1,0,0,0];

    $user = Auth::user();
    $user_id = Auth::id();
    $flg_judge = false;

    // 日跨ぎ処理
    $today_data = Attendance::where('user_id', $user_id)->where('date', new Carbon('today'))->get();
    $yesterday_data = Attendance::where('user_id', $user_id)->where('date', new Carbon('yesterday'))->get();

    if($today_data->isEmpty()) { // 今日のデータがないとき
      if($yesterday_data->isEmpty()) { // 昨日のデータもなければ勤務なし状態
        $state_work = State::NOT_WORK; 
        $flg_judge = false;
      }
      else {
        close();
        $flg_judge = true;
      }

    }
    else {
      $flg_judge = true;
    }

    // 勤務状態判定
    if($flg_judge) {
      $attendance = Attendance::where('user_id', $user_id)->where('date', new Carbon('today'))->whereNull('end_time')->get()->first();

      $state_work = State::NOT_WORK;
      if($attendance != NULL) {
        $state_work = State::WORKING; // attendancesテーブルにend_time欠けがあったら勤務中に上書き

        $rest = $attendance->rests()->whereNull('end_time')->get()->first();
        
        if($rest != NULL) {
          $state_work = State::RESTING; // restテーブルにend_time欠けがあったら休憩中に上書き
        }
      }
    }

    // ボタン状態を更新
    switch ($state_work) {
      case State::NOT_WORK:
          $btn_state = [1,0,0,0];
          break;
      case State::WORKING:
          $btn_state = [0,1,1,0];
          break;
      case State::RESTING:
          $btn_state = [0,0,0,1];
          break;
      default:
          $btn_state = [1,0,0,0];
          break;
    }
    
    // $param = ['rests' => $rests, 'user' => $user, 'attendances' => $attendances];
    // return view('index', compact('todos' , 'user'));
    //return view('index', $param);  
    return view('index',compact('btn_state', 'user'));   
  }  

  /**
     * ボタン押下
     */
    public function store(Request $request)
    { 
      $btn_state = [0,0,0,0];
      $user = Auth::user();
      $user_id = Auth::id();
      $target = Attendance::where('user_id', $user_id)->whereNull('end_time')->get()->first(); //end_timeが空のレコードを取得
      
      //targetが空でない時取得
      if($target != NULL) {
        $attendance_id = $target->id;
        $target_rest = Rest::where('attendance_id', $attendance_id)->whereNull('end_time')->get()->first(); //end_timeが空のレコードを取得
      }  

      // 日跨ぎ処理
      if (!$request->has('work_start')) {

          $today_data = Attendance::where('user_id', $user_id)->where('date', new Carbon('today'))->get();
          if($today_data->isEmpty()) {
            close(); 
          }
      }
      

      if ($request->has('work_start')) {
          $btn_state = [0,1,1,0];
          $date = new Carbon('today');  // 勤務開始の日付を記録
          $work_start = Carbon::now(); // 現在時刻

          Attendance::create(['user_id' => $user_id,
                              'date' => $date,
                              'start_time' => $work_start]);
      } 
      elseif ($request->has('work_end')) {
          $btn_state = [1,0,0,0];
          $work_end = Carbon::now(); // 現在時刻

          $target->end_time = $work_end;
          $target->save(); //targetに終了時刻を格納
      } 
      elseif ($request->has('rest_start')) {
          $btn_state = [0,0,0,1];
          $rest_start = Carbon::now(); // 休憩開始時刻を記録

          Rest::create(['attendance_id' => $attendance_id,
                        'start_time' => $rest_start]);
      }
      elseif ($request->has('rest_end')) {
          $btn_state = [0,1,1,0];
          $rest_end = Carbon::now(); // 現在時刻

          $target_rest->end_time = $rest_end;
          $target_rest->save();
      }

      return view('index',compact('btn_state', 'user'));   
    }

    public function date(Request $request)
    {  
      $user_id = Auth::id();
      // Todo::create(['content' => $request->content,
      //               'tag_id' => $request->tag_id,
      //               'user_id' => $user_id]);
      return view('date',compact('user'));
      }

}
