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

use App\Models\MoneyRecord as MoneyRecord;

class LuckMoney{

    private $account;

    private $companyName;

    private $activityName;

    private $wish;

    private $remark ='红包备注';

    public function __construct( AccountModel $account ){

        $this->account = $account;


    }

    public function setCompanyName( $name ){
        $this->companyName = $name;
        return $this;
    }

    public function setActivityName( $name ){
        $this->activityName = $name;
        return $this;
    }

    public function setRemark( $remark ){
        $this->remark = $remark;
        return $this;
    }

    public function setWish( $wish ){
        $this->wish = $wish;
        return $this;
    }

    public function getBusiness(){
        $business = new Business(
            $this->account->app_id,
            $this->account->app_secret,
            $this->account->mch_id,
            $this->account->mch_key
        );


        $business->setClientCert(public_path('cert/fzpd/apiclient_cert.pem'));
        $business->setClientKey(public_path('cert/fzpd/apiclient_key.pem'));

        return $business;
    }



    public function send($openid, $amount, $acivity_id){

        $record = new MoneyRecord();

        $record->activity_id = $acivity_id;
        $record->amount = $amount;

        $record->open_id = $openid;



        $business = $this->getBusiness();


        $luckMoneyServer = new Money($business);

        $luckMoneyData['mch_billno'] = time();  //红包记录对应的商户订单号
        $luckMoneyData['send_name'] = $this->companyName;  //红包发送者名称
        $luckMoneyData['re_openid'] =  $openid;  //红包接收者的openId
        $luckMoneyData['total_amount'] = $amount;  //红包总额（单位为分），现金红包至少100，裂变红包至少300
        $luckMoneyData['total_num'] = 1;  //现金红包时为1，裂变红包时至少为3
        $luckMoneyData['wishing'] =  $this->wish;
        $luckMoneyData['act_name'] = $this->activityName;
        $luckMoneyData['remark'] = $this->remark;


        $record->bill_no = $luckMoneyData['mch_billno'];

        $result = $luckMoneyServer->send($luckMoneyData, Money::TYPE_CASH_LUCK_MONEY);

        if( $result['result_code']  ==  "FAIL"){
            return $result;
        }

        $record->save();

        return $result;
    }

    public function sendLuckMoney(){



    }

    public function init(AccountModel $account ){


    }
}