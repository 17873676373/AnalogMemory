<?php
/**
 * Created by PhpStorm.
 * User: 老王专用
 * Date: 2019/4/15
 * Time: 21:52
 */

namespace app\exception;


class SuccessMessage extends BaseException
{
    public $code = "201";
    public $msg = "操作成功";
    public $errorCode = "00000";
}