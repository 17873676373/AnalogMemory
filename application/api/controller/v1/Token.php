<?php
/**
 * Created by PhpStorm.
 * User: 老王专用
 * Date: 2019/4/14
 * Time: 12:04
 */

namespace app\api\controller\v1;


use app\api\validate\TokenGet;
use app\api\service\TokenUser;

class Token
{
    public function getToken($code,$raw_data){
        (new TokenGet())->goCheck();
        $token = (new TokenUser($code,$raw_data))->get();
        return $token;
    }
}