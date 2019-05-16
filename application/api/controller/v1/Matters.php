<?php
/**
 * Created by PhpStorm.
 * User: 老王专用
 * Date: 2019/4/15
 * Time: 18:45
 */

namespace app\api\controller\v1;


use app\api\model\Matters as MattersModel;
use app\api\service\Aphorisms;
use app\api\service\Token as TokenService;
use app\api\validate\dateCheck;
use app\api\validate\IDCheck;
use app\api\validate\MatterCreate;
use app\api\validate\MatterUpdate;
use app\exception\MatterException;
use app\exception\SuccessMessage;
use think\Cache;

class Matters
{
    public function createMatter(){
        $Validate = new MatterCreate();
        $Validate->goCheck();
        $array = $Validate->getDateByRule(input('post.'));
        (new MattersModel())->saveMatter($array);
        throw new SuccessMessage();
    }
    public function updateMatter(){
        $Validate = new MatterUpdate();
        $Validate->goCheck();
        $array = $Validate->getDateByRule(input('post.'));
        (new MattersModel())->updateMatter($array);
        throw new SuccessMessage();
    }
    public function deleteMatter($id,$sign_id){
        (new IDCheck())->goCheck();
        (new MattersModel())->destroyMatter($id,$sign_id);
        throw new SuccessMessage();
    }
    public function startStudyMatter($id){
        (new IDCheck())->goCheck();
        $model = new MattersModel();
        $duration = $model->startStudy($id);
        $backgroud_url = $model->getBackGroundUrl();
        $aphorism = Aphorisms::getAphorisms();
        throw new SuccessMessage(['msg' => [
            'img' => $backgroud_url,
            'aphorism' => $aphorism
        ]]);
    }
    public function stopStudyMatter($id){
        (new IDCheck())->goCheck();
        $model = new MattersModel();
        $return = $model->stopStudy($id);
        if($return){
            return json([
                'msg' => '今日计划学习时间已达到，自动打卡',
                'flag' => 1,
            ]);
        }
        throw new SuccessMessage();
    }
    public function monitorPlanTime(){

    }
}
