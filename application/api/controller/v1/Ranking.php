<?php
/**
 * Created by PhpStorm.
 * User: 老王专用
 * Date: 2019/4/20
 * Time: 9:41
 */

namespace app\api\controller\v1;

use app\api\model\Sign as SignModel;

class Ranking
{
    public function getTodayRanking(){
        $date = strtotime(date("Y-m-d"));
        $result = (new SignModel())->getRanking($date);
        return json($result);
    }
}