<?php
/**
 * Created by PhpStorm.
 * User: 老王专用
 * Date: 2019/4/15
 * Time: 18:54
 */

namespace app\api\validate;


class IDCheck extends BaseValidate
{
    protected $rule = [
        'id' => 'require|isMustInteger'
    ];
    protected $message = [
        'id' => 'id不是正整数'
    ];
}