<?php
/**
 * Created by PhpStorm.
 * User: LEO
 * Date: 1/22/16
 * Time: 1:36 PM
 */

namespace app\Http\Middleware;

use App\Console\Commands\Fans;
use App\Repositories\ActivityRepository;
use Closure;
use App\Services\Account as AccountService;
use App\Repositories\AccountRepository;
use App\Models\Account as AccountModel;
use Overtrue\Wechat\Auth;
use App\Services\Fan as FanService;
use Log;

class ActivityAuth
{

    private $account;

    public function __construct( AccountService $accountService)
    {
//        $repositorie = new AccountRepository(new AccountModel());
//
//        $this->account = $repositorie->getById(5);
    }

    public function handle($request, Closure $next)
    {

        if( !$request->has('activity')){

            dd('bad request');
        }

        $activity_id = $request->input('activity');

        $actRepo = new ActivityRepository();

	    $activity = $actRepo->getById( $activity_id );


	    if( empty($activity) ){

		    dd('bad request parameter');
	    }


	    $repositorie = new AccountRepository(new AccountModel());

	    $this->account = $repositorie->getById( $activity->account_id);

	    $auth = new Auth( $this->account->app_id, $this->account->app_secret);

        $user = $request->session()->get('logged_user');
        if ( !$request->session()->has('logged_user') || $user->account_id != $this->account->id ) {

            try{
                $user = $auth->authorize( $request->fullUrl() ); // 返回用户 Bag

                $fans = new FanService();
                $remoteUser = $fans->getRemoteFanByOpenid($this->account ,$user->openid );

                $user->merge( $remoteUser );

                if( $user->sex == 1 ){
                    $user->sex = '男';
                }else{
                    $user->sex = '女';
                }

                $user = $fans->storeFan( $this->account, $user );

                $request->session()->put('logged_user', $user );
            }catch(\Exception $e ){
                Log::debug('authorize'. $e->getMessage());

                Log::debug('authorize'. $e->getTraceAsString());
                return activity_view('error');
            }

//            $_SESSION['logged_user'] = $user->all();
            // 跳转到其它授权才能访问的页面
        } else {
            $user = $request->session()->get('logged_user');
        }

        if( $user->isSubscribed() ){

            return $next($request);
        }else{
            $request->session()->forget('logged_user');
        }

        return redirect( url('subscribe/' . $this->account->id ) );


    }

}