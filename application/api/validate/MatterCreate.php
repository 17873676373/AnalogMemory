<?php
/**
 * Created by PhpStorm.
 * User: 老王专用
 * Date: 2019/4/15
 * Time: 20:55
 */

namespace app\api\validate;


class MatterCreate extends BaseValidate
{
    protected $rule = [
        'sign_id' => 'require|isMustInteger',
        'duration' => 'require',
        'target' => 'require',
        'timing' => 'require',
    ];
    protected $message = [
        'sign_id' => 'id不是正整数'
    ];
}