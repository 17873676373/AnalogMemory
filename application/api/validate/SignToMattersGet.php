<?php
/**
 * Created by PhpStorm.
 * User: 老王专用
 * Date: 2019/4/18
 * Time: 20:53
 */

namespace app\api\validate;


class SignToMattersGet extends BaseValidate
{
    protected $rule = [
        'date' => "checkDateFormat",
        'id' => 'require|isMustInteger'
    ];
    protected $message = [
        'date' => "日期验证规则错误,正确格式为'2019-04-15'",
        'id' => 'id不是正整数'
    ];
}