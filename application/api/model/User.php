<?php
/**
 * Created by PhpStorm.
 * User: 老王专用
 * Date: 2019/4/15
 * Time: 17:17
 */

namespace app\api\model;



use app\api\service\Token;

class User extends BaseModel
{

    protected $hidden = ["id","openid","create_time","update_time"];
    public function getByOpenID($openid){
        return $this->where('openid','=',$openid)
            ->find();
    }
    public function setMotto($motto){
        self::where("id","=",$this->user_id)
            ->update([
                'motto' => $motto,
            ]);
        return $motto;
    }
}