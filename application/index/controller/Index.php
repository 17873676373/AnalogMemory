<?php
namespace app\index\controller;

use think\Cache;

class Index
{
    //页式存储
    public function printTable()
    {
        $table = new \app\api\service\Table();
        return json($table->getTableCache());
    }
    public function transTable($address){
        $table = new \app\api\service\Table();
        $table_size = Cache::get('table_size');
        $table = $table->getTableCache();
        $table_number = intval($address/$table_size);
        $block_number = $table[$table_number];
        $table_address = $address%$table_size;
        //页号超出页号数
        if ($table_number > count($table)){
            return json([
                'error' => 1,
                'info' => '地址越界'
            ]);
        }

        //页内偏移大于页面大小
        if ($table_address > $table_size){
            return json([
                'error' => 1,
                'info' => '地址越界'
            ]);
        }
        $physics_address = $table_size*$block_number+$table_address;
        return json([
            'error' => 0,
            'table_size' => $table_size,
            'table_number' => $table_number,
            'block_number' => $block_number,
            'table_address' => $table_address,
            'physics_address' => $physics_address,
        ]);
    }
    public function transTableOut(){
        $table = new \app\api\service\Table();
        return $table->rmTableCache();
    }

    //段式存储
    public function printSect(){
        $table = new \app\api\service\Table();
        return json($table->getSectCache());
    }
    public function transSect($number,$address){
        $table = new \app\api\service\Table();
        $sect = $table->getSectCache();
        //段号号超出段号数
        if ($number > count($sect)){
            return json([
                'error' => 1,
                'info' => '地址越界，段号号超出段长'
            ]);
        }
        $array = $sect[$number];
        //段内偏移大于段长
        if ($array['sect_size']<$address){
            return json([
                'error' => 1,
                'info' => '地址越界,段内偏移大于段长'
            ]);
        }
        $physics_address_max = $array['sect_address']+$address;
        return json([
            'error' => 0,
            'number' => $number,
            'sect_address' => ($array['sect_address']),
            'physics_address' => $physics_address_max,
        ]);
    }
    public function transSectOut(){
        $table = new \app\api\service\Table();
        $table->rmSectCache();
    }

    //段页式存储
    public function printSectTable(){
        $table = new \app\api\service\Table();
        return json($table->getTableSectCache());
    }
    public function transSectTable($number,$address){
        $table = new \app\api\service\Table();
        $sect = $table->getTableSectCache();
        //段号号超出段号数
        if ($number > count($sect)){
            return json([
                'error' => 1,
                'info' => '地址越界,段号号超出段号数'
            ]);
        }
        $array = $sect[$number];

        //计算页内偏移
        $table_address = $address%$array['table_size'];

        //页号超出页号数
        $table_number = intval($address/$array['table_size']);
        if ($table_number > $array['table_length']){
            return json([
                'error' => 1,
                'info' => '地址越界,页号超出页号数'
            ]);
        }

        $physics_address = $array['table_size']*$array['table'][$table_number]+$table_address+$array['table_address'];
        return json([
            'error' => 0,
            'table_size' => $array['table_size'],
            'table_number' => $table_number,
            'block_number' => $array['table'][$table_number],
            'table_address' => $table_address,
            'physics_address' => $physics_address,
        ]);
    }
    public function transSectTableOut(){
        $table = new \app\api\service\Table();
        $table->rmTableSectCache();
    }
}
