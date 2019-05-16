<?php
/**
 * Created by PhpStorm.
 * User: 老王专用
 * Date: 2019/4/16
 * Time: 19:43
 */

namespace app\api\controller\v1;

use app\api\model\Future as FutureModel;
use app\api\validate\FutureCreate;
use app\api\validate\FutureUpdate;
use app\api\validate\IDCheck;
use app\exception\FutureException;
use app\exception\SuccessMessage;
use app\api\service\TokenUser;

class Future
{
    public function getAllFuturePlans(){
        $user_id = TokenUser::getUidByTokenVar();
        $model = new FutureModel();
	$today = strtotime(date('Y-m-d'));
        $result = $model->where('future_date','>',$today)
	->order('future_date')
        ->select(function ($query) use ($user_id){
            $query->where('user_id', '=', $user_id);
        })->toArray();
        return json($result);
    }
    public function createFuturePlan(){
        $validate = new FutureCreate();
        $validate->goCheck();
        $array = $validate->getDateByRule(input('post.'));
        $array['user_id'] = TokenUser::getUidByTokenVar();
        $array['future_date'] = strtotime($array['future_date']);
        $model = (new FutureModel())->save($array);
        if(!$model){
            throw new FutureException([
                'msg' => '新增未来事件异常',
            ]);
        }
        throw new SuccessMessage();
    }
    public function updateFuturePlan(){
        $validate = new FutureUpdate();
        $validate->goCheck();
        $array = $validate->getDateByRule(input('post.'));
        (new FutureModel())->updateFuture($array);
        throw new SuccessMessage();
    }
    public function deleteFuturePlan($id){
        (new IDCheck())->goCheck();
        (new FutureModel())->destroyFuture($id);
        throw new SuccessMessage();
    }
}
