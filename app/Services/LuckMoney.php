<?php
/**
 * Created by PhpStorm.
 * User: LEO
 * Date: 1/19/16
 * Time: 2:34 PM
 */

namespace app\Services;

use Overtrue\Wechat\Payment\Business;
use Overtrue\Wechat\LuckMoney as Money;
use App\Models\Account as AccountModel;

class LuckMoney{

    private $account;

    public function __construct( AccountModel $account ){

        $this->account = $account;
    }


    public function send($openid, $amount, $type, $account){



        $business = new Business(
            $account->app_id,
            $account->app_secret,
            '1238293202',
            'qTjzQBY3bkFMWMRyFBcHE8tKEbhpvgHV'
        );

        $business->setClientCert(public_path('cert/apiclient_cert.pem'));
        $business->setClientKey(public_path('cert/apiclient_key.pem'));

        $luckMoneyServer = new Money($business);

        $luckMoneyData['mch_billno'] = time();  //红包记录对应的商户订单号
        $luckMoneyData['send_name'] = '某某公司';  //红包发送者名称
        $luckMoneyData['re_openid'] =  $openid;  //红包接收者的openId
        $luckMoneyData['total_amount'] = 100;  //红包总额（单位为分），现金红包至少100，裂变红包至少300
        $luckMoneyData['total_num'] = 1;  //现金红包时为1，裂变红包时至少为3
        $luckMoneyData['wishing'] = '祝福语';
        $luckMoneyData['act_name'] = '活动名称';
        $luckMoneyData['remark'] = '红包备注';
        $luckMoneyData['client_ip'] = '123.56.120.83';

        $result = $luckMoneyServer->send($luckMoneyData, Money::TYPE_CASH_LUCK_MONEY);

        dd( $result );


        dd( $account->app_id );
    }

    public function sendLuckMoney(){



    }

    public function init(AccountModel $account ){


    }
}