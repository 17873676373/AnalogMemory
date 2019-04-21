<?php
/**
 * Created by PhpStorm.
 * User: 老王专用
 * Date: 2019/4/16
 * Time: 9:51
 */

namespace app\api\controller\v1;

use app\api\service\Token as TokenService;
use app\api\validate\dateCheck;
use app\api\validate\IDCheck;
use app\api\validate\MonthCheck;
use app\api\validate\SignCreate;
use app\api\validate\SignToMattersGet;
use app\api\validate\TimeCheck;
use app\exception\SignException;
use app\exception\SuccessMessage;
use app\api\model\Sign as SignModel;
use think\Exception;

class Sign
{
    public function getSignDateOnMatters(){
        (new dateCheck())->goCheck();
        $date = input('get.date');
        if(empty($date)){
            $date = strtotime(date("Y-m-d"));
        }else{
            $date = strtotime($date);
        }
        $result = (new SignModel())->getMattersBySignIdAndDate($date);
        return json($result);
    }
    public function CreateSign(){
        $validate = new SignCreate();
        $validate->goCheck();
        $array = $validate->getDateByRule(input("post."));
        if(empty($array)){
            $array['date'] = strtotime(date('Y-m-d'));
        }else{
            $array['date'] = strtotime($array['date']);
        }
        $model = new SignModel();
        $model->createSignDate($array);
        throw new SuccessMessage();
    }
    public function getMonthSign(){
        (new MonthCheck())->goCheck();
        $month = strtotime(input('get.month')?input('get.month'):date('Y-m'));
        $result = (new SignModel())->getMonth($month);
        return json($result);
    }
    public function setTodayPlanTime(){
        //通过id修改内容
        (new TimeCheck())->goCheck();
        $array = [];
        $time = input('post.time');
        $array['date'] = strtotime(date('Y-m-d'));
        (new SignModel())->setPlanTime($array,$time);
        throw new SuccessMessage([
            'msg' => '更新成功'
        ]);
    }
}