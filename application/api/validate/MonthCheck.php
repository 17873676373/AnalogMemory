<?php
/**
 * Created by PhpStorm.
 * User: 老王专用
 * Date: 2019/4/17
 * Time: 18:19
 */

namespace app\api\validate;


class MonthCheck extends BaseValidate
{
    protected $rule = [
        'month' => "checkMonthFormat",
    ];
    protected $message = [
        'month' => "月份验证规则错误,正确格式为'2019-04'"
    ];
}