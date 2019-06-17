<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Route;

Route::post("api/:v/token/user","api/:v.Token/getToken");

Route::get("api/:v/matter/startstudy/:id","api/:v.Matters/startStudyMatter");
Route::get("api/:v/matter/stopstudy/:id","api/:v.Matters/stopStudyMatter");
Route::post("api/:v/matter/create","api/:v.Matters/createMatter");
Route::post("api/:v/matter/update","api/:v.Matters/updateMatter");
Route::delete("api/:v/matter/delete/:id/:sign_id","api/:v.Matters/deleteMatter");

Route::get("api/:v/sign/getmatters","api/:v.Sign/getSignDateOnMatters");
Route::post("api/:v/sign/create","api/:v.Sign/createSign");
Route::get("api/:v/sign/getmonth","api/:v.Sign/getMonthSign");
Route::post("api/:v/sign/studytime","api/:v.Sign/setTodayStudyTime");
Route::post("api/:v/sign/plantime","api/:v.Sign/setTodayPlanTime");

Route::get("api/:v/future","api/:v.Future/getAllFuturePlans");
Route::post("api/:v/future/create","api/:v.Future/createFuturePlan");
Route::post("api/:v/future/update","api/:v.Future/updateFuturePlan");
Route::delete("api/:v/future/delete/:id","api/:v.Future/deleteFuturePlan");

Route::get("api/:v/ranking","api/:v.Ranking/getTodayRanking");
Route::get("api/:v/rankingbycontinuity","api/:v.Ranking/getTodayRankingByContinuity");

Route::post("api/:v/user/setmotto","api/:v.User/setMotto");
Route::get("api/:v/user/getinformation","api/:v.User/getDetailedInformation");

Route::post("api/:v/feedback", "api/:v.Feedback/setFeedback");
return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],

];
