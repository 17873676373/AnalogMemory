<?php
/**
 * Created by PhpStorm.
 * User: 老王专用
 * Date: 2019/4/15
 * Time: 20:36
 */

namespace app\exception;


class MatterException extends BaseException
{
    public $code = "404";
    public $msg = "待办事项未找到";
    public $errorCode = "20001";
}