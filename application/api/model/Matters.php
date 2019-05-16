<?php
/**
 * Created by PhpStorm.
 * User: 老王专用
 * Date: 2019/4/15
 * Time: 19:05
 */

namespace app\api\model;


use app\exception\BaseException;
use app\exception\MatterException;
use think\Cache;
use traits\model\SoftDelete;

class Matters extends BaseModel
{
    use SoftDelete;

    protected $hidden = ['create_time','update_time','delete_time','user_id','date','img_id','sign_id'];
    public function img(){
        return $this->belongsTo("Image","img_id","id");
    }
    public function saveMatter($array){
        $array['user_id'] = $this->user_id;
        $array['img_id'] = rand(1,4);
        $result = $this->save($array);
        if(!$result){
            throw new MatterException([
                'msg' => '新增待办事项异常',
                'errorCode' => 2002,
            ]);
        }
        $this->setSignOnMatterStatus($array['sign_id']);
    }
    public function destroyMatter($id,$sign_id){
        $this->userOrAdminConsistency($id, $this->user_id);
        $model = self::destroy($id);
        if(!$model){
            throw new MatterException([
                'msg' => '删除事项失败',
                'code' => 403,
                'errorCode' => 2004,
            ]);
        }
        $this->setSignOnMatterStatus($sign_id);
    }
    public function updateMatter($array){
        $this->userOrAdminConsistency($array['id']);
        $model = self::update($array);
        if(!$model){
            throw new MatterException([
                'msg' => '更新待办事项异常',
                'errorCode' => 2003,
            ]);
        }
    }
    public function startStudy($id){
        $this->userConsistency($id, $this->user_id);
        $var = $this->getMatterVar($id);
        if($var['identifier'] == 0){
            $this->cacheTimingData($id, $var['duration']);
            $array = [];
            $array['id'] = $id;
            $array['identifier'] = 1;
            self::update($array);
        }
    }
    public function stopStudy($id){
        $this->userConsistency($id, $this->user_id);
        $var = $this->getMatterVar($id);
        $array = [];
        $array['id'] = $id;
        $array['identifier'] = 0;
        $array['status'] = 1;
        self::update($array);
        if($var['identifier'] == 1){
            $cache_time = Cache::get($id);
            if($cache_time){
                $duration = time()-$cache_time;
                Cache::rm($id);
                //主要停止计时，计入总签到和连续签到方法
                return (new Sign)->setIncTodayStudyTime($duration);
            }else{
                return (new Sign)->setIncTodayStudyTime($var['duration']);
            }
        }
    }
    protected function getMatterVar($id){
        $result = self::get($id);
        if(!$result){
            throw new MatterException();
        }
        return $result;
    }
    protected function cacheTimingData($id, $duration){
        $cache_time = Cache::get($id);
        if(!$cache_time){
            $cache_time = time();
            Cache::set($id, $cache_time, $duration);
        }
    }
    protected function userOrAdminConsistency($id){
        $result = self::get($id);
        if(!$result){
            throw new MatterException();
        }
        if($result->user_id != $this->user_id){
            throw new BaseException([
                'msg' => '用户不一致，不允许此操作',
                'code' => 403,
                'errorCode' => 1004
            ]);
        }
    }
    protected function userConsistency($id, $user_id){
        $model = self::get($id);
        if(!$model){
            throw new  MatterException();
        }
        $result = $model->visible(['user_id'])->toArray();
        if($result['user_id'] != $user_id){
            throw new BaseException([
                'msg' => '用户不一致，不允许此操作',
                'code' => 403,
                'errorCode' => 1004
            ]);
        }
    }
    protected function setSignOnMatterStatus($sign_id){
        if($this->isEmptyMatter($sign_id)){
            Sign::where('id','=',$sign_id)->update([
                'matter_status' => 1
            ]);
        }else{
            Sign::where('id','=',$sign_id)->update([
                'matter_status' => 0
            ]);
        }
    }
    protected function isEmptyMatter($sign_id){
        $result = $this->where("sign_id",'=',$sign_id)
            ->select();
        if($result->isEmpty()){
            return false;
        }else{
            return true;
        }
    }
}