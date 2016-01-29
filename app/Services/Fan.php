<?php

namespace App\Services;

use Overtrue\Wechat\User as UserService;
use App\Models\Fan as FanModel;
use App\Repositories\FanRepository as FanRepo;

class Fan
{

    private $userService;


    public function isExist( $account, $openid ){

    }


    public function storeFan( $account, $user ){

        $fanRepo = new FanRepo();

        return $fanRepo->saveOrUpdate( $account->id, $user->all() );

    }


    public function getRemoteFanByOpenid( $account, $openid ){

        $userService = new UserService( $account->app_id, $account->app_secret);

        $user = $userService->get( $openid );

        return $user;
    }

    /**
     * 从微信数据格式化.
     *
     * @param array $fan
     *
     * @return array
     */
    public function formatFromWeChat($fan)
    {

        return [
            'openid' => $fan['openid'],
            'nickname' => $fan['nickname'],               //昵称
            'sex' => $fan['sex']==1 ? '男' : '女',                         //性别
            'city' => $fan['city'],                       //城市
            'country' => $fan['country'],                 //国家
            'province' => $fan['province'],               //省
            'language' => $fan['language'],               //语言
            'avatar' => $fan['headimgurl'],               //头像
            'subscribed_at' => date('Y-m-d H:i:s', $fan['subscribe_time']), //关注时间
            'unionid' => array_get($fan, 'unionid'),                 //unionid
            'remark' => $fan['remark'],                   //备注
            'group_id' => $fan['groupid'] ? $fan['groupid'] : 0, //组ID
            'updated_at' => date('Y-m-d H:i:s'),
            'deleted_at' => null,
        ];
    }
}
