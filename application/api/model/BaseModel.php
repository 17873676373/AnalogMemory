<?php
/**
 * Created by PhpStorm.
 * User: 老王专用
 * Date: 2019/4/15
 * Time: 17:19
 */

namespace app\api\model;


use think\Model;

class BaseModel extends Model
{
    protected function urlPrefix($value,$date){
        $url = $value;
        if($date['from'] == 0){
            $url = config('setting.url_prefix').$value;
        }
        return $url;
    }
}