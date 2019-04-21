<?php
/**
 * Created by PhpStorm.
 * User: 老王专用
 * Date: 2019/4/20
 * Time: 17:01
 */

namespace app\api\controller\v1;

use app\api\validate\UserSetMotto;
use app\api\model\User as UserModel;
use app\exception\SuccessMessage;

class User
{
    public function setMotto($motto){
        (new UserSetMotto())->goCheck();
        if(!$motto){
            $motto = "这个人很懒，什么都没留下";
        }
        (new UserModel())->setMotto($motto);
        throw new SuccessMessage();
    }
}