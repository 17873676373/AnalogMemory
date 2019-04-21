<?php
/**
 * Created by PhpStorm.
 * User: 老王专用
 * Date: 2019/4/16
 * Time: 20:15
 */

namespace app\exception;


class FutureException extends BaseException
{
    public $code = "404";
    public $msg = "未来计划未找到";
    public $errorCode = "40001";
}