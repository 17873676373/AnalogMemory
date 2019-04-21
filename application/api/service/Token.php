<?php
/**
 * Created by PhpStorm.
 * User: 老王专用
 * Date: 2019/4/9
 * Time: 19:46
 */

namespace app\api\service;


use app\exception\TokenException;
use think\Cache;
use think\Exception;
use think\Request;

class Token
{
    public static function generateToken(){
        $randChar = getRandChar(32);
        //获取当前时间戳
        $timestamp = $_SERVER['REQUEST_TIME'];
        $tokenSalt = config('secure.token_salt');
        return md5($randChar.$timestamp.$tokenSalt);
    }
    protected static function getTokenVarByToken($key){
        $token = Request::instance()->header("token");
        $value = Cache::get($token);
        if(!$value){
            throw new TokenException();
        }else{
            if(!is_array($value)){
                $value = json_decode($value,true);
            }
            if(array_key_exists($key,$value)){
                return $value[$key];
            }else{
                throw new Exception('尝试获取的Token变量不存在');
            }
        }
    }
    public static function getUidByTokenVar(){
        $uid = self::getTokenVarByToken('uid');
        return $uid;
    }
    public static function getSessionKeyByTokenVar(){
        $uid = self::getTokenVarByToken('session_key');
        return $uid;
    }
    public static function getNameByTokenVar(){
        $uid = self::getTokenVarByToken('nickName');
        return $uid;
    }
    public static function getImgUrlTokenVar(){
        $uid = self::getTokenVarByToken('avatarUrl');
        return $uid;
    }
    public static function checkToken(){
        $token = Request::instance()->header("token");
        $value = Cache::get($token);
        if (!$value) {
            throw new TokenException();
        }
    }

}