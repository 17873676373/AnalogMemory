<?php
/**
 * Created by PhpStorm.
 * User: 老王专用
 * Date: 2019/6/17
 * Time: 15:32
 */

namespace app\api\controller\v1;


class Table
{
    public function printTable(){
        $table = new \app\api\service\Table();
        $table->setTableCache(10);
    }
}