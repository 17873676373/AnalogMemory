<?php
/**
 * Created by PhpStorm.
 * User: 老王专用
 * Date: 2019/4/16
 * Time: 20:20
 */

namespace app\api\validate;


class FutureUpdate extends BaseValidate
{
    protected $rule = [
        'title' => '',
        'plan' => '',
        'future_date' => 'checkDateFormat',
        'id' => 'require|isMustInteger'
    ];

    protected $message = [
        'future_date' => "日期验证规则错误,正确格式为'2019-04-15'"
    ];
}