<?php
/**
 * Created by PhpStorm.
 * User: 老王专用
 * Date: 2019/4/17
 * Time: 17:01
 */

namespace app\api\validate;


class TimeCheck extends BaseValidate
{
    protected $rule = [
        'time' => 'require|isMustInteger'
    ];
    protected $message = [
        'time' => '时间格式不正确'
    ];
}