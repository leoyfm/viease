<?php
/**
 * Created by PhpStorm.
 * User: LEO
 * Date: 6/03/2016
 * Time: 11:35 AM
 */

namespace app\Http\Controllers\Activity;

use App\Http\Controllers\Controller;

use App\Models\Activist;
use App\Services\Account as AccountService;
use App\Services\Activity as ActivityService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Repositories\AccountRepository as ActRepo;
use App\Models\Activity as Activity;

use App\Repositories\FanRepository as FanRepo;
use App\Models\MoneyRecord as MoneyRecord;

use App\Services\LuckMoney;



class ShakeController extends Controller
{

    const ACT_NUM = 5;

    private $account;

    private $actRepo;

    private $fanRepo;

    /**
     * @var ActivityService
     */
    private $service;


    public function __construct(AccountService $as, Request $request, ActRepo $actRepo, FanRepo $fanRepo)
    {
        $as->chose(1);
        $this->account = $this->account();
        $this->service = new ActivityService(self::ACT_NUM);
        $this->current_user = $request->session()->get('logged_user');
        $this->actRepo = $actRepo;
        $this->fanRepo = $fanRepo;
//        $this->current_user = Fan::find(6);
        //qiniu

    }


	private function getTodaySendMoney(){
		$money_record = MoneyRecord::where("created_at",">=",Carbon::today() )
			    ->where("created_at", "<=", Carbon::now())->get();

		$sendMoney = 0;

		foreach( $money_record as $record ){

			$sendMoney += $record->amount;
		}

		return $sendMoney;
	}

    /**
     * 游戏页面
     * @return
     */
    public function getIndex( Request $request ){

        $account = $request->session()->get('account');

        $activity = $request->session()->get('activity');

        $user = $request->session()->get('current_user');

        if( $account == null || $activity == null || $user == null ){

	        return activity_view("shake.error")->with("msg", "请通过摇一摇重新登陆");
        }

        $sign = $this->generateSign( $account, $activity, $user );

	    //check today send money;
	    $totalMony = 20000;
	    $sendMony = $this->getTodaySendMoney();

	    $remainingMony = $totalMony - $sendMony;
	    if( $remainingMony < 100 ){

		    return activity_view("shake.error")->with("msg", "已经被抢光了,明天再来吧");
	    }


        return activity_view("shake.index", ["remaining" => $remainingMony, "sign" => $sign, "activity" => $activity, 'user' => $user]);
 //       return activity_view("shake.error")->with("msg", "活动已结束");
    }

    private function generateSign( $account, $activity, $user ){

        $str = http_build_query(["accountid" => $account->id, "activityid" => $activity->id, "userid"=>$user->id ] );

        $str = md5($str);

        return $str;

    }
    private function checkSign( $account, $activity, $user ,$sign ){

        $str = http_build_query(["accountid" => $account->id, "activityid" => $activity->id, "userid"=>$user->id ] );

        $str = md5($str);

        if( $str == $sign )
            return true;
        else
            return false;

    }

    /**
     * 摇一摇 页面
     * @return
     */
    public function getShake(){

        return activity_view("shake.shake");
    }
    public function getShake2(){

        return activity_view("shake.shake2");
    }

    public function getWard( Request $request ){
	    return activity_view("shake.error")->with("msg", "请重新摇一摇");
    }


	public function postUser(Request $request ){
		$user = $request->session()->get('logged_user');
		$name = $request->input('name');
		$tel = $request->input('tell');

		$activist = new Activist();

		$activist->name = $name;
		$activist->tel = $tel;
		$activist->activity_id = 6;
		$activist->user_id = $user->id;
		$activist->save();

		return redirect("activities/6");

	}

    public function postWard(Request $request){

        $activity_id = $request->input("activity", "");
        $user_id = $request->input("user", "");


        if( $activity_id != null && $user_id ){


            $activity = $activity = Activity::find( $activity_id );
            $account = $this->actRepo->getById( $activity->account_id );

            $user = $this->fanRepo->getById( $user_id );

            

            $sign = $request->input("sign");



            if( $this->checkSign( $account, $activity, $user, $sign) ){

	            $sendMoney = $this->getTodaySendMoney();

	            if( (20000 - $sendMoney) < 100 ){
		            return activity_view("shake.error")->with("msg", "奖金领完了,请明天再来");
	            }

                $service = new LuckMoney( $account );

                $service->setCompanyName( "凡森电子" );
                $service->setActivityName($activity->name);
                $service->setWish("新年快乐");
                $service->setRemark("备注");

                $amount = rand(100,200);
                $result = $service->send( $user->openid, $amount, $activity->id );
                if( $result['result_code']  ==  "FAIL"){

                    if( $result["err_code"] == "SENDNUM_LIMIT"){

	                    return activity_view("shake.error")->with("msg", "你已经领过红包了,明天再来吧");

                    }

                }else{
	                return activity_view("shake.error")->with("msg", "领奖成功");
                }
            }



        }

        return activity_view("shake.error")->with("msg", "你已经领过红包了,明天再来吧");

    }

}