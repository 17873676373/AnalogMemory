<?php
/**
 * Created by PhpStorm.
 * User: 老王专用
 * Date: 2019/4/14
 * Time: 12:09
 */

namespace app\api\validate;


class TokenGet extends BaseValidate
{
    protected $rule = [
        'code' => 'require|isNotEmpty'
    ];
    protected $msg = [
        'code' => '只有code码才可以换取token值'
    ];
}