<?php
/**
 * Created by PhpStorm.
 * User: 老王专用
 * Date: 2019/4/20
 * Time: 16:54
 */

namespace app\api\validate;


class UserSetMotto extends BaseValidate
{
    protected $rule = [
        'motto' => 'chsDash'
    ];
}