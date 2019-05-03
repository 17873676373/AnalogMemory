<?php
/**
 * Created by PhpStorm.
 * User: 老王专用
 * Date: 2019/4/15
 * Time: 16:49
 */

namespace app\api\service;


use app\api\model\User as UserModel;
use app\exception\TokenException;
use app\exception\WeChatException;
use think\Exception;

class TokenUser extends Token
{
    protected $appID;
    protected $appSecret;
    protected $code;
    protected $loginUrl;
    protected $raw_data = [];

    function __construct($code,$raw_data)
    {
        $this->code = $code;
        $this->appID = config('wx.app_id');
        $this->appSecret = config('wx.app_secret');
        $this->loginUrl = sprintf(config('wx.login_url'),$this->appID,$this->appSecret,$this->code);
        $this->raw_data = json_decode($raw_data,true);
    }

    /**
     * 获取令牌
     * @return string
     * @throws Exception
     * @throws WeChatException
     */
    public function get(){
        $result = curl_get($this->loginUrl);
        //获取到的openid和sessionkey为json格式，要将其装换成数组封装进缓存
        $wxResult = json_decode($result, true);
        if(empty($result)){
            throw new Exception('获取session_key和openID时异常');
        }else{
            $loginFail = array_key_exists('errcode',$wxResult);
            if($loginFail){
                $this->processLoginError($wxResult);
            }else{
                return $this->grantToken($wxResult);
            }
        }
    }

    /**
     * 生成令牌写入缓存
     * @param $wxResult
     * @return string
     */
    private function grantToken($wxResult){
        //生成令牌写入缓存
        //key 令牌：随机数
        //value $WxResult $uid $scope(权限等级);
        $openid = $wxResult['openid'];
        $user = (new UserModel())->getByOpenID($openid);
        if($user){
            $uid = $user->id;
        }else{
            $uid = $this->newUser($openid);
        }
        $cachedValue = $this->prepareCachedValue($wxResult,$uid);
        //写入缓存,返回令牌
        $token = $this->saveToCache($cachedValue);
        return $token;
    }

    /**
     * 写入缓存
     * @param $cacheValue
     * @return string
     */
    private function saveToCache($cacheValue){
        //生成随机写到Token基类中，供其他service类应用
        $key = self::generateToken();
        $cacheValue = json_encode($cacheValue);
        $expire_in = config('secure.token_expire_in');
        $result = cache($key, $cacheValue, $expire_in);

        if (!$result){
            throw new TokenException([
                'msg' => '服务器缓存异常',
                'errorCode' => 10005
            ]);
        }
        return $key;
    }

    /**
     * 准备缓存数据
     * @param $wxResult
     * @param $uid
     * @return mixed
     */
    private function prepareCachedValue($wxResult,$uid){
        $cachedValue = $wxResult;
        $cachedValue += $this->raw_data;
        $cachedValue['uid'] = $uid;
        $cachedValue['scope'] = 16;
        return $cachedValue;
    }
    private function newUser($openid){
        $user = UserModel::create([
            'name' => $this->raw_data['nickName'],
            'img_url' => $this->raw_data['avatarUrl'],
            'openid' => $openid,
        ]);
        return $user->id;
    }
    private function processLoginError($wxResult){
        throw new WeChatException([
            'msg' => $wxResult['errmsg'],
            'errorCode' => $wxResult['errcode'],
        ]);
    }
}