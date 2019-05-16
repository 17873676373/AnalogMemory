<?php
/**
 * Created by PhpStorm.
 * User: 老王专用
 * Date: 2019/4/15
 * Time: 17:19
 */

namespace app\api\model;


use app\api\service\Token;
use think\Model;

class BaseModel extends Model
{
    protected $user_id;
    public function initialize()
    {
//       $this->user_id = Token::getUidByTokenVar();
         $this->user_id = 4;
        parent::initialize(); // TODO: Change the autogenerated stub
    }
    protected function urlPrefix($value,$date){
        $url = $value;
        if($date['from'] == 0){
            $url = config('setting.url_prefix').$value;
        }
        return $url;
    }
    public function getBackGroundUrl(){
        $number = mt_rand(1, config('setting.background_total'));
        $value = "/Background".$number.config('setting.background_suffix');
        $url = config('setting.url_prefix').$value;
        return $url;
    }
}
