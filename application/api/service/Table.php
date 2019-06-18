<?php
/**
 * Created by PhpStorm.
 * User: 老王专用
 * Date: 2019/6/17
 * Time: 15:34
 */

namespace app\api\service;


use think\Cache;

class Table
{
    public function setTableCache(){
        //页面大小随机生成，单位为Byte
        $line = rand(10,20);
        $m = rand(9,13);
        $table_size = 2;
        for ($i=0; $i<$m; $i++){
            $table_size = $table_size*2;
        }
        Cache::set('table_size',$table_size);
        $array = [];
        for ($i=0; $i<$line; $i++){
            $array[$i] = $i;
        }
        shuffle($array);
        Cache::set('table',json_encode($array));
        return $array;
    }
    public function getTableCache(){
        if (Cache::has('table')){
            return json_decode(Cache::get('table'),true);
        }else{
            return $this->setTableCache();
        }
    }
    public function rmTableCache(){
        return Cache::rm('table');
    }

    public function setSectCache(){
        $line = rand(5,10);
        //随机生成基址，单位为Byte
        //段长随机生成限制
        $array = [];
        for ($i=1; $i<=$line; $i++){
            $array[$i]['sect_address'] = rand(($i)*1024, ($i+1)*1024);
            $array[$i]['sect_size'] = rand(100, ($i+1)*1024-$array[$i]['sect_address']);
        }
        Cache::set('sect', json_encode($array));
        return $array;
    }
    public function getSectCache(){
        if (Cache::has('sect')){
            return json_decode(Cache::get('sect'),true);
        }else{
            return $this->setSectCache();
        }
    }
    public function rmSectCache(){
        return Cache::rm('sect');
    }

    public function setTableSectCache(){
        $line = rand(5,10);
        $array = [];
        for ($i=1; $i<=$line; $i++){
            //随机生成页面大小，单位为Byte
            $m = rand(6,8);
            $table_size = 2;
            for ($n=0; $n<$m; $n++){
                $table_size = $table_size*2;
            }
            //页表长度
            $table_length = rand(5,8);
            //生成对应页表
            for ($j=0; $j<$table_length; $j++){
                $array[$i]['table'][$j] = $j;
            }
            shuffle($array[$i]['table']);
            $array[$i]['table_address'] = rand($i*6*1024, ($i+1)*5*1024);
            $array[$i]['table_size'] = $table_size;
            $array[$i]['table_length'] = $table_length;
        }
        Cache::set('ts_sect', json_encode($array));
        return $array;
    }
    public function getTableSectCache(){
        if (Cache::has('ts_sect')){
            return json_decode(Cache::get('ts_sect'),true);
        }else{
            return $this->setTableSectCache();
        }
    }
    public function rmTableSectCache(){
        return Cache::rm('ts_sect');
    }
}