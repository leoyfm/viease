<?php
/**
 * Created by PhpStorm.
 * User: LEO
 * Date: 1/27/16
 * Time: 3:40 PM
 */

namespace App\Http\Controllers;

use Qiniu\Auth;

class QinNiuController extends Controller
{

    public function test(){

        $accessKey = 'RNzC5Ruc8caDer_YwWux7OMK3jq3GJGf5AxxlIEV';
        $secretKey = '3C49Pwt3qKh85LLwL_rB81N3ZQKLEalQvBUt8qN5';

        $auth = new Auth($accessKey, $secretKey);

        // 要上传的空间
        $bucket = 'firsen-lawhelper-pic';

        // 生成上传 Token
        $token = $auth->uploadToken($bucket);

        // 要上传文件的本地路径
        $filePath = './php-logo.png';

        // 上传到七牛后保存的文件名
        $key = 'my-php-logo.png';

        // 初始化 UploadManager 对象并进行文件的上传。
        $uploadMgr = new UploadManager();
        list($ret, $err) = $uploadMgr->putFile($token, $key, $filePath);
        echo "\n====> putFile result: \n";
        if ($err !== null) {
            var_dump($err);
        } else {
            var_dump($ret);
        }

        return 'ss';
    }

}