<?php
/**
 * Created by PhpStorm.
 * User: 老王专用
 * Date: 2019/4/18
 * Time: 20:33
 */

namespace app\api\validate;


class SignCreate extends BaseValidate
{
    protected $rule = [
        'date' => "checkDateFormat",
    ];
    protected $message = [
        'date' => "日期验证规则错误,正确格式为'2019-04-15'"
    ];
}