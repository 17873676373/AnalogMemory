<?php
/**
 * Created by PhpStorm.
 * User: 老王专用
 * Date: 2019/4/14
 * Time: 12:07
 */

namespace app\api\validate;


use app\exception\ParamException;
use think\Request;
use think\Validate;

class BaseValidate extends Validate
{
    public function goCheck(){
        $param = Request::instance()->param();
        if(!$this->batch()->check($param)){
            throw new ParamException([
                'msg' => $this->getError(),
            ]);
        }
        return true;
    }
    protected function isNotEmpty($value){
        if (empty($value)) {
            return false;
        } else {
            return true;
        }
    }
    protected function isMustInteger($value){
        if (is_numeric($value) && is_int($value + 0) && ($value + 0) > 0) {
            return true;
        }
        return false;
    }
    protected function checkDateFormat($value)
    {
        // 首先是验证日期的一般格式
        if (preg_match("/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/", $value, $parts)) {
            if (checkdate( $parts[2], $parts[3], $parts[1])) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    protected function checkMonthFormat($value)
    {
        // 首先是验证月份的一般格式
        if (preg_match("/^([0-9]{4})-([0-9]{2})$/", $value, $parts)) {
            return true;
        } else {
            return false;
        }
    }
    public function getDateByRule($array){
        if(array_key_exists('user_id',$array)&&array_key_exists('uid',$array)){
            throw new ParamException([
                'msg' => '请求中有非法请求参数uid或user_id',
            ]);
        }
        $newArray = [];
        foreach ($this->rule as $key => $value){
            $newArray[$key] = $array[$key];
        }
        return $newArray;
    }
}