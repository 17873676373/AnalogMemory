<?php
/**
 * Created by PhpStorm.
 * User: 老王专用
 * Date: 2019/4/15
 * Time: 22:03
 */

namespace app\api\validate;


class MatterUpdate extends BaseValidate
{
    protected $rule = [
        'id' => 'require|isMustInteger',
        'duration' => 'require',
        'target' => 'require',
        'timing' => 'require',
    ];
}