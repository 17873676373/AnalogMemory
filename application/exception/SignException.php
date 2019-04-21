<?php
/**
 * Created by PhpStorm.
 * User: 老王专用
 * Date: 2019/4/16
 * Time: 10:35
 */

namespace app\exception;


class SignException extends BaseException
{
    public $code = "404";
    public $msg = "日期签到信息未找到";
    public $errorCode = "30001";
}