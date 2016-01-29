<?php
/**
 * Created by PhpStorm.
 * User: LEO
 * Date: 1/26/16
 * Time: 6:27 PM
 */

namespace App\Services;

use \DateTime;
use Overtrue\Wechat\Utils\JSON;
use Qiniu\Auth;
class OSS
{

    private $attr = array();

    private $accessKey = 'RNzC5Ruc8caDer_YwWux7OMK3jq3GJGf5AxxlIEV';
    private $secretKey = '3C49Pwt3qKh85LLwL_rB81N3ZQKLEalQvBUt8qN5';
    private $bucket = 'firsen-lawhelper-pic';

    private $policy = array();
    private $host = '';

    private $auth;

    public function __construct()
    {
        $this->auth = new Auth($this->accessKey, $this->secretKey);
    }

    public function setBucket( $bucket ){
        $this->bucket = $bucket;
        return $this;
    }

    public function policy( $data = array() ){
        $this->policy = $data;
        return $this;
    }

    public function getUploadToken(){
        $upToken = $this->auth->uploadToken($bucket, null, 3600, $policy);
    }



}