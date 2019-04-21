<?php
/**
 * Created by PhpStorm.
 * User: 老王专用
 * Date: 2019/4/16
 * Time: 20:07
 */

namespace app\api\validate;


class FutureCreate extends BaseValidate
{
    protected $rule = [
        'title' => 'require',
        'plan' => 'require',
        'future_date' => 'require',
    ];
}