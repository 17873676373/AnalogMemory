<?php
/**
 * Created by PhpStorm.
 * User: 老王专用
 * Date: 2019/4/20
 * Time: 11:14
 */

namespace app\api\model;


class Image extends BaseModel
{
    protected $hidden = ['update_time','delete_time','id','from'];
    public function getImgUrlAttr($value,$date){
        return $this->urlPrefix($value,$date);
    }
}