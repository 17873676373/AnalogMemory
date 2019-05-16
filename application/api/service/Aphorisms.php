<?php
/**
 * Created by PhpStorm.
 * User: 老王专用
 * Date: 2019/5/16
 * Time: 19:54
 */

namespace app\api\service;


class Aphorisms
{
    public static function getAphorisms(){
        $json = file_get_contents(SITE_PATH."/public/static/json/AphorismsJson.json");
        $array = json_decode($json, false);
        $number = rand(0,39);
        return $array[$number];
    }
}