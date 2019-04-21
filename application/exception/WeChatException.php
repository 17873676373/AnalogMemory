<?php
/**
 * Created by PhpStorm.
 * User: 老王专用
 * Date: 2019/4/15
 * Time: 17:18
 */

namespace app\exception;


class WeChatException extends BaseException
{
    public $code = "401";
    public $msg = "微信登录异常";
    public $errorCode = "10001";

}