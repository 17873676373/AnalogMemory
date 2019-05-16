<?php
/**
 * Created by PhpStorm.
 * User: 老王专用
 * Date: 2019/5/16
 * Time: 19:28
 */

namespace app\admin\controller;


use app\admin\model\ToJson;
use think\Controller;

class Aphorisms extends Controller
{
    public function AphorismsToJson(){
        $ToJson = new ToJson();
        $result = $ToJson->getAphorismsToJson();
        if($result){
            return "Yes";
        }else{
            return "No";
        }
    }
    public function getAphorisms(){
        $json = file_get_contents(SITE_PATH."/public/static/json/AphorismsJson.json");
        $array = json_decode($json, false);
        var_dump($array);
    }
}