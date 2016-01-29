<?php
/**
 * Created by PhpStorm.
 * User: LEO
 * Date: 1/27/16
 * Time: 4:05 PM
 */

namespace app\Http\Controllers\Video;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;
use Qiniu\Auth;
class VideoController extends Controller
{
    public function getIndex(){

        return 'sss';
    }

    public function postCallback(Request $request){



        $_body = file_get_contents('php://input');
        $body = json_decode($_body, true);


        return response()->json( $body);


        $fname = $body['fname'];
        $fkey = $body['fkey'];
        $desc = $body['desc'];

        $date = new DateTime();
        $ctime = $date->getTimestamp();





        header('Content-Type: application/json');
        if (!$ok)
        {
            $resp = $DB->errorInfo();
            http_response_code(500);
            echo json_encode($resp);
            return;
        }

        $resp = array('ret' => 'success');
        echo json_encode($resp);

    }

    public function getList(){

        $result = Video::paginate(5);

        return view('video.list', ['data'=> $result]);
    }

    public function getUpload(){

        return view('video.upload');
    }

    public function postUpload(Request $request){

        $video = new Video( $request->all() );

        $video->save();

        return view('video.upload');
    }

    public function getUploadUrl(){

        $accessKey = 'RNzC5Ruc8caDer_YwWux7OMK3jq3GJGf5AxxlIEV';
        $secretKey = '3C49Pwt3qKh85LLwL_rB81N3ZQKLEalQvBUt8qN5';
        $bucket = 'lawvideo';

        $pfopOps = "avthumb/m3u8";
        $policy = array(
            'persistentOps' => $pfopOps,
        );

//        $bucket = Config::BUCKET_NAME;
//        $accessKey = Config::ACCESS_KEY;
//        $secretKey = Config::SECRET_KEY;
        $auth = new Auth($accessKey, $secretKey);

//        $policy = array(
//            'callbackUrl' => 'http://vi.ponyhelp.com/video/callback',
//            'callbackBody' => '{"fname":"$(fname)", "fkey":"$(key)", "desc":"$(x:desc)"}'
//        );

        $upToken = $auth->uploadToken($bucket, null, 3600, $policy);

        return response()->json(['uptoken'=> $upToken])->header('Access-Control-Allow-Origin','*');


    }

}