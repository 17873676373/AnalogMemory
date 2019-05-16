<?php
/**
 * Created by PhpStorm.
 * User: 老王专用
 * Date: 2019/5/16
 * Time: 19:30
 */

namespace app\admin\model;


class ToJson
{
    public function getAphorismsToJson(){
        $s = file_get_contents(SITE_PATH."/public/Aphorisms.txt");
        $array = explode('。',$s);
        unset($array[31]);
        $json = json_encode($array);
        $result = file_put_contents(SITE_PATH."/public/static/json/AphorismsJson.json",$json);
        if($result){
            return true;
        }else{
            return false;
        }
    }

}